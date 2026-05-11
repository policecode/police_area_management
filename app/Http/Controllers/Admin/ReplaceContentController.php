<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReplaceContent;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ReplaceContentController extends Controller
{
    public function getItems(Request $request)
    {
        try {
            //code...
            $query = ReplaceContent::filter($request);
            $res = [
                'result' => 1,
                'data' => [],
                'page' => $query->getPageNumber(),
                'per_page' => $query->getPerPage(),
                'total' => 0
            ];
            if ($request->is_paginate) {
                $res['total'] = $query->getTotal();
            } else {
                $res['data']  = $query->get();
            }
            return response()->json($res);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0,
                'data' => [],
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function store(Request $request, Story $story)
    {
        $validator = Validator::make($request->all(), $this->rules($request), $this->messages(), $this->attributes());
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors(),
                'message' => 'validation'
            ]);
        }
        $data = $validator->validated();
        $isCheck = ReplaceContent::GetByStory($story->id)->GetByOldContent($data['old_content'])->first();
        if ($isCheck) {
            return response()->json([
                'status' => 0,
                'message' => 'Cụm từ đã tồn tại'
            ]);
        }
        try {
            $result = ReplaceContent::create([
                'story_id' => $story->id,
                'old_content' => $data['old_content'],
                'new_content' => $data['new_content']
            ]);
            return response()->json([
                'status' => 1,
                'data' => $result,
                'message' => 'Thêm cụm từ mới thành công'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(ReplaceContent $replaceContent)
    {
        try {
            $status = $replaceContent->delete();
            return response()->json([
                'status' => $status,
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function handleReplaceContent(Request $request, Story $story)
    {
        DB::beginTransaction();

        try {
            $replaceContents = ReplaceContent::where('story_id', $story->id)->get();
            $affectedChapterIds = [];

            if ($replaceContents->isNotEmpty()) {
                // Làm sạch các ký tự rác phổ biến trước khi thay thế nội dung
                $hexGarbage = ['E2808B', 'E2808C', 'E2808D', 'EFBBBF'];
                foreach ($hexGarbage as $hex) {
                    DB::table('chapers')
                    ->where('story_id', $story->id)
                    ->where('content', 'LIKE', DB::raw("CONCAT('%', UNHEX('" . $hex . "'), '%')"))
                    ->update([
                        'content' => DB::raw("REPLACE(content, UNHEX('" . $hex . "'), '')")
                    ]);
                }
                // Xử lý từng cụm từ cần thay thế
                foreach ($replaceContents as $item) {
                    $cleanOldContent = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $item->old_content);
                    $cleanNewContent = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $item->new_content);  
                    // Tạo pattern (giữ nguyên cách dùng (?i) của bạn)
                    $pattern = '(?i)' . preg_quote($cleanOldContent, '/');
                    // 1. Tìm các chương chứa nội dung này (không phân biệt hoa thường)
                    $ids = DB::table('chapers')
                        ->where('story_id', $story->id)
                        ->where('content', 'REGEXP', $pattern)
                        ->pluck('id')
                        ->toArray();
                 
                    if (!empty($ids)) {
                        $affectedChapterIds = array_unique(array_merge($affectedChapterIds, $ids));
                        
                        // 2. Thực hiện cập nhật 
                        $quotedOld = DB::getPdo()->quote($cleanOldContent);
                        $quotedNew = DB::getPdo()->quote($cleanNewContent);

                        DB::table('chapers')
                            ->whereIn('id', $ids)
                            ->update([
                                'content' => DB::raw("REGEXP_REPLACE(content, $quotedOld, $quotedNew, 1, 0, 'i')")
                            ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => 1,
                'message' => 'Thay thế nội dung thành công (không phân biệt hoa thường).',
                'affected_chapters' => array_values($affectedChapterIds),
                'total_affected' => count($affectedChapterIds)
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 400);
        }
    }

    private function rules($request)
    {
        $rules = [
            'old_content' => 'required',
            'new_content' => 'required',
        ];

        return $rules;
    }

    private function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'integer' => ':attribute phải là số'
        ];
    }

    private function attributes()
    {
        return [
            'story_id' => 'ID truyện',
            'old_content' => 'Nội dung cũ',
            'new_content' => 'Nội dung mới'
        ];
    }
}

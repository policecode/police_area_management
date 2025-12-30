<?php

namespace App\Http\Controllers\Member;

use App\Enums\ReportChapterStatus;
use App\Http\Controllers\Controller;
use App\Models\ReportChapter;
use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class ReportChapterController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function reportChapter(Request $request) {
         $validator = Validator::make($request->all(), [
            'story_id' => ['required', 'numeric', 'exists:stories,id'],
            'chapter_id' => ['required', 'numeric', 'exists:chapers,id'],
            'content' => 'required|max:500'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors(),
                'message' => 'validation'
            ]);
        }
        DB::beginTransaction();
        try {
            $data = $validator->validated();
            $user = Auth::user();
            $reportChapter = ReportChapter::GetByUser($user->id)->GetByChapter($data['chapter_id'])->first();
            $message = '';
            if ($reportChapter) {
                $reportChapter->content = $data['content'];
                if ($reportChapter->status == ReportChapterStatus::SUCCESS['id']) {
                    $reportChapter->status = ReportChapterStatus::REPEAT['id'];
                }
                $reportChapter->update();
                $message = 'Bạn đã báo cáo chương này, chúng tôi sẽ cập nhật lại nội dung báo cáo';
            } else {
                $story = Story::find($data['story_id']);
                ReportChapter::create([
                    'user_id' => $user->id,
                    'story_id' => $data['story_id'],
                    'chapter_id' => $data['chapter_id'],
                    'content' => $data['content'],
                    'status' => ReportChapterStatus::WAITING['id']
                ]);
                $story->total_report += 1;
                $story->update();
                $message = 'Chúng tôi đã tiếp nhận nội dung bạn báo cáo của bạn, chúng tôi sẽ xử lý trong thời gian sớm nhất';

            }
           
            DB::commit();
            return response()->json([
                'status' => 1,
                'message' => $message
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoppyrightStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class CoppyrightStoryController extends Controller
{

    public function getItems(Request $request)
    {
      
        try {
            //code...
            $query = CoppyrightStory::JoinUser()->filter($request);
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
                $results = $query->get();
                $results->each(function ($item, $key) {
                    $item->avatar_url = $item->avatar ? asset($item->avatar) : asset('assets/images/avatar_default.png');
                });
                $res['data'] = $results;
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
    public function handleCoppyrightStories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'story_id' => 'required',
            'action' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors(),
                'message' => 'validation'
            ]);
        }
        $data = $validator->validated();
        try {
            DB::beginTransaction();
            if ($data['action'] == 'add') {
                $collection = CoppyrightStory::GetByStory($data['story_id'])->GetByUser($data['user_id'])->first();
                if (!$collection) {
                    CoppyrightStory::create([
                        'user_id' => $data['user_id'],
                        'story_id' => $data['story_id']
                    ]);
                }
                $message = 'Add Stories coppyright success';
            } elseif ($data['action'] == 'remove') {
                CoppyrightStory::GetByStory($data['story_id'])->GetByUser($data['user_id'])->delete();
                $message = 'Delete Stories coppyright success';

            }
            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => '',
                'message' => $message
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $hot_stories = Story::orderBy('star_count', 'ASC')->skip(0)->take(15)->get()->each(function ($item, $key) use ($now) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $dt = new Carbon($item->created_at); //Tạo 1 datetime
            $item->after_day = $now->diffInDays($dt);;
        })->toArray();
        $dataView = array(
            'page_title' => 'Trang chủ',
            'hot_stories' => $hot_stories
        );

        return view('client_page.home', $dataView);
    }

    public function searchKeyword(Request $request)
    {
        try {
            if (!((int)$request->per_page > 0)) {
                return response()->json([
                    'result' => 1,
                    'data' => [],
                    'total' => 0
                ]);
            }
            // DB::enableQueryLog();
            $query = Story::filter($request);
            $res = [
                'result' => 1,
                'data' => [],
                'page' => $query->getPageNumber(),
                'per_page' => $query->getPerPage(),
            ];
            if ($request->keyword) {
                $query->searchByAuthor($request->keyword);
            }
            if ($request->cat_id) {
                $query->getByCategory($request->cat_id);
            }

            $now = Carbon::now();
            $res['data'] = $query->get()->each(function ($item, $key) use($now) {
                $item->thumbnail = route('index') . '/' . $item->thumbnail;
                $item->url = route('client.story', ['story_slug' => $item->slug]);

                $dt = new Carbon($item->created_at); //Tạo 1 datetime
                $item->after_day = $now->diffInDays($dt);;
            });
            // dd(DB::getQueryLog());
            return response()->json($res);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0,
                'data' => [],
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

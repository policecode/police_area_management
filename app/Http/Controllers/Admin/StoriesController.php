<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusStory;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Chaper;
use App\Models\Story;
use App\Models\StoryCategory;
use App\Models\ViewDay;
use App\Models\ViewMonth;
use App\Models\ViewWeek;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataView = array(
            'page_title' => 'Quản lý truyện',
        );
       
        return view('admin_page.stories.lists', $dataView);
    }
    public function getItems(Request $request) {
        // Thêm dữ liệu vào trong query
      // $request->merge(array_merge($queryDefault, $request->query()));

      try {
        //code...
        $query = Story::filter($request);
        $res = [
            'result' => 1,
            'data' => [],
            'page' => $query->getPageNumber(),
            'per_page' => $query->getPerPage(),
            'total' => 0
        ];
        if($request->is_paginate){
            $res['total'] = $query->getTotal();
        }else{
            $results = $query->get();
            $story_arr= $results->pluck('id');
            $listStoryCat = StoryCategory::whereIn('story_id', $story_arr)->get()->groupBy('story_id');
            $listCat = [];
            foreach ($listStoryCat as $key => $items) {
                for ($i=0; $i < $items->count(); $i++) { 
                    $listCat[$key][] = $items[$i]->category_id;
                }
            }
            $results->each(function ($item, $key) use($listCat){
                $item->thumbnail = route('index') . '/' . $item->thumbnail;
                $item->url = route('client.story', ['story_slug' => $item->slug]);
                $item->category = $listCat[$item->id];
            });
            $res['data'] = $results;
        }
        return response()->json($res);
      } catch (\Throwable $e) {
        return response()->json([
            'result' => 0, 'data'=> [], 'message' => $e->getMessage()
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
        try {
            $validator = Validator::make($request->all(), $this->rules($request), $this->messages(), $this->attributes());
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0, 
                    'errors' => $validator->errors(),
                    'message' => 'validation'
                ]);
            }
            DB::beginTransaction();
            $data = $validator->validated();
    
            $user = Auth::user();
            $thumbnail = '';
     
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('stories/thumbnail');
            }
    
            $story = Story::create([
                'user_id' => $user->id,
                'title' => $data['title'],
                'slug' => $data['slug'],
                'thumbnail' => $thumbnail,
                'description' => $data['description'],
                'author_id' => $data['author_id'],
                'status' => $data['status'],
            ]);
            // Add Category
            $listStoryCategory = [];
            if (is_array($data['category']) && (count($data['category']) > 0)) {
                foreach ($data['category'] as $key => $cat) {
                    $listStoryCategory[] = [
                        'story_id' => $story->id,
                        'category_id' => $cat
                    ];
                }
                
            }
      
            if ((count($listStoryCategory) > 0)) {
                StoryCategory::insert($listStoryCategory);
            }
            DB::commit();
            return response()->json([
                'status' => 1, 
                'data' => $story,
                'message' => 'Create success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
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
    public function update(Request $request, Story $story)
    {

        try {
            $validator = Validator::make($request->all(), $this->rules($request), $this->messages(), $this->attributes());
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0, 
                    'errors' => $validator->errors(),
                    'message' => 'validation'
                ]);
            }
            DB::beginTransaction();
            $data = $validator->validated();
    
            $dataUpdate = [
                'title' => $data['title'],
                'slug' => $data['slug'],
                'description' => $data['description'],
                'author_id' => $data['author_id'],
                'status' => $data['status'],
            ];
    
            if ($request->hasFile('thumbnail')) {
                Storage::delete($story->thumbnail);
                $thumbnail = $request->file('thumbnail')->store('stories/thumbnail');
                $dataUpdate['thumbnail'] = $thumbnail;
            }
    
            $story->update($dataUpdate);
            // Add Category
            $listStoryCategory = [];
            if (is_array($data['category']) && (count($data['category']) > 0)) {
                foreach ($data['category'] as $key => $cat) {
                    $listStoryCategory[] = [
                        'story_id' => $story->id,
                        'category_id' => $cat
                    ];
                }
            }
            StoryCategory::where('story_id', $story->id)->delete();
            if ((count($listStoryCategory) > 0)) {
                StoryCategory::insert($listStoryCategory);
            }
            DB::commit();
            return response()->json([
                'status' => 1, 
                'data' => $story,
                'message' => 'Update success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        try {
            DB::beginTransaction();
            Storage::delete($story->thumbnail);
            Chaper::getByStory($story->id)->delete();
            StoryCategory::where('story_id', $story->id)->delete();
            ViewDay::where('story_id', $story->id)->delete();
            ViewWeek::where('story_id', $story->id)->delete();
            ViewMonth::where('story_id', $story->id)->delete();
            $status = $story->delete();
            DB::commit();
            return response()->json([
                'status' => $status, 
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }

    public function autoConvertDescriptionToHtml() {
        $listStory = Story::where('description', 'LIKE','%\n%')->get();
        $count = 0;
        foreach ($listStory as $key => $story) {
            $story->description = preg_replace("/[\n]+/", "\n\n",$story->description);
            $story->description = nl2br($story->description);
            $story->description = preg_replace("/\n/", "",$story->description);
            $story->update();
            $count++;
        }
 
        return response()->json([
            'data' => $listStory[0], 
            'count' =>  $count,
            'status' => 1,
        ]);
    }

    private function rules($request)
    {
        $rules = [
            'title' => 'required|max:255|unique:stories,title',
            'slug' => 'required|unique:stories,slug',
            'author_id' => 'required|integer',
            'status' => 'required|integer',
            'description' => '',
            'category' => 'array'
        ];
        if ($request->id) {
            $rules['title'] = 'required|unique:stories,title,'.$request->id;
            $rules['slug'] = 'required|unique:stories,slug,'.$request->id;
      
        }
        return $rules;
    }

    private function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute phải từ :min ký tự',
            'integer' => ':attribute phải là số'
        ];
    }

    private function attributes()
    {
        return [
            'title' => 'Tên truyện',
            'slug' => 'Đường dẫn tĩnh',
            'email' => 'Email',
            'password' => 'Mật khâu',
            'group_id' => 'Nhóm',
            'author_id' => 'Tác giả',
            'status' => 'Trạng thái truyện',
            'description' => 'Thông tin về truyện'
        ];
    }

    public function getthumbnail(Request $request) {
           // $images = Storage::disk('public')->put('example.txt', 'Anh Là Nguyễn Hoàng Đạt');
        // $images = $request->file('thumbnail')->store('stories/thumbnail');
        //  asset('storage/photos/131622436_2878115665801114_8573924252147972299_n.jpg')
        // $contents = Storage::url('example.txt');
        // $file = $request->hasFile('thumbnail');
        // Tạo ảnh cục bộ, phòng ngừa bị download
        return Storage::get('photos/3DVeDHCK808EGGEAfQV90ePa1PUrnf650WLOV7Fu.jpg');
    }

    public function toolUploadStory(Request $request) {
        $data = $request->all();
        
        try {
            DB::beginTransaction();
            $isCheckStory = Story::getBySlug(Str::slug($data['title'], "-"))->first();
            if ($isCheckStory) {
                $lastChaper = Chaper::getByStory($isCheckStory->id)->orderBy('position', 'DESC')->first();
                $skip_position = 1;
                if ($lastChaper) {
                    $skip_position = $lastChaper->position + 1;
                }
                return response()->json([
                    'status' => 1, 
                    'data' => $isCheckStory,
                    'message' => $data['title'].' đã tồn tại',
                    'skip_position' => $skip_position
                ]);
            } 
            // return response()->json([
            //     'status' => 1, 
            //     'data' => Str::slug($data['title'], "-"),
            //     'message' => $data['title'].' đã tồn tại'
            // ]);
            // Add Author
            $author = Author::getBySlug($data['author'])->first();
            if (!$author) {
                $author = Author::create([
                    'name' => $data['author'],
                    'slug' => Str::slug($data['author'], "-")
                ]);
            }
            
            // Add story
            $thumbnail = '';
            if ($request->hasFile('avatar')) {
                    $thumbnail = $request->file('avatar')->store('stories/thumbnail');
                }
            $enumStatus = [];
            foreach (StatusStory::getValues() as $key => $enumObj) {
                if ($enumObj['slug'] == Str::slug($data['status'])) {
                    $enumStatus = $enumObj;
                }
            }
            $status = StatusStory::COMMINGOUT['key'];
        
            if (count($enumStatus) > 0) {
                $status = $enumStatus['key'];
            }
        
            $story = Story::create([
                'user_id' => 1,
                'title' => $data['title'],
                'slug' => Str::slug($data['title'], "-"),
                'thumbnail' => $thumbnail,
                'description' => $data['description'],
                'author_id' => $author->id,
                'status' => $status
            ]);
            // Add Category
            $listStoryCategory = [];
            if (is_array($data['category']) && (count($data['category']) > 0)) {
                foreach ($data['category'] as $key => $cat) {
                    $tmpCat = Category::getBySlug(Str::slug($cat, "-"))->first();
                    if (!$tmpCat) {
                        $tmpCat = Category::create([
                            'name' => $cat,
                            'slug' => Str::slug($cat, "-")
                        ]);
                    }
               
                    $listStoryCategory[] = [
                        'story_id' => $story->id,
                        'category_id' => $tmpCat->id
                    ];
                }
                
            }
      
            if ((count($listStoryCategory) > 0)) {
                StoryCategory::insert($listStoryCategory);
            }
            DB::commit();
            return response()->json([
                'status' => 1, 
                'data' => $story,
                'message' => 'Create success',
                'skip_position' => 1
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0, 'data'=> [], 'message' => $e->getMessage()
            ], 200);
        }
    }
    public function toolUploadChaper(Request $request, Story $story) {
        try {
            DB::beginTransaction();
            $list_chapers = $request->list_chaper;
            $listPosition = [];
            foreach ($list_chapers as $key => $chaper_obj) {
                $listPosition[] = $chaper_obj['position'];
            }
            $resultChapers = Chaper::getByStory($story->id)->whereIn('position',$listPosition)->get();
 
            $dataInsert = [];
            foreach ($list_chapers as $key => $chaper_obj) {
                $flag = true;
                if (count($resultChapers) > 0) {
                    foreach ($resultChapers as $k => $obj) {
                        if ($obj->position == $chaper_obj['position']) {
                            $flag = false;
                        }
                    }
                }
                # code...
                if ($flag) {
                    $dataInsert[] = array_merge((array)$chaper_obj, array(
                        'user_id' => 1,
                        'slug' => Str::slug($chaper_obj['name'], "-"),
                        'story_id' => $story->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ));
                }
                
            }
            $result = '';
            if (count($dataInsert) > 0) {
                $result = Chaper::insert($dataInsert);
                $last_record = Chaper::orderBy('id', 'DESC')->first();
                $story->update([
                    'last_chapers' => Carbon::now(),
                    'chaper_id' => $last_record->id
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 1, 
                'data' => $result,
                'message' => 'Upload '.count($dataInsert).' records'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0, 'data'=> [], 'message' => $e->getMessage()
            ], 200);
        }
    }
}

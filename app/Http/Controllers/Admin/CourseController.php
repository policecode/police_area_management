<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\CategoiesCourse;
use App\Models\Category;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queryDefault = array(
            'per_page' => 10,
        );
        // Thêm dữ liệu vào trong query
        $request->merge(array_merge($queryDefault, $request->query()));
        $query = Course::filter($request);
        // echo '<pre>';
        // print_r($query->get()->toArray());
        // echo '</pre>'; die;
        $dataView = array(
            'page_title' => 'Quản lý khóa học',
            'records' => $query->get(),
            'page' => $query->getPageNumber(),
            'per_page' => $query->getPerPage(),
            'total_records' => $query->getTotal()
        );
        return view('admin_page.courses.lists', $dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd($this->getCategories()->toArray());
        $dataView = array(
            'page_title' => 'Thêm khóa học mới',
            'categories' => $this->getCategories(),
            'teachers' => $this->getTeachers(),

        );
        return view('admin_page.courses.create', $dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $course = Course::create($data);
            $catIds = $data['categories'];
    
            $categoiesCourse = array();
            foreach ($catIds as $value) {
                $categoiesCourse[] = array(
                    'category_id' => $value,
                    'course_id' => $course->id,
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s'),
                );
            }
            CategoiesCourse::insert($categoiesCourse);
            DB::commit();
            return redirect()->route('admin.courses.index')->with('msg', __('messages.success_create'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('msg', $th->getMessage());
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
        $course = Course::with('categories')->find($id);
        $catIds = array();
        foreach ($course->categories as $cat) {
            $catIds[] = $cat->id;
        }
        $course->catIds = $catIds;

        $dataView = array(
            'page_title' => 'Chỉnh sửa thông tin khóa học',
            'item' => $course,
            'categories' => $this->getCategories(),
            'teachers' => $this->getTeachers(),
        );
        return view('admin_page.courses.edit', $dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $course->update($data);
            $categoiesCourses = CategoiesCourse::getByCourseId($course->id)->get(); //Quan hệ trong table
            $catIds = $data['categories']; //Quan hệ mới trong update
            if (count($categoiesCourses) >= count($catIds)) {
                for ($i=0; $i < count($categoiesCourses); $i++) { 
                    if ($i < count($catIds)) {
                        $categoiesCourses[$i]->update(array(
                            'category_id' => $catIds[$i],
                        ));
                    } else {
                        $categoiesCourses[$i]->delete();
                    }
                }
            } else {
                for ($i=0; $i < count($catIds); $i++) { 
                    if ($i < count($categoiesCourses)) {
                        $categoiesCourses[$i]->update(array(
                            'category_id' => $catIds[$i],
                        ));
                    } else {
                        CategoiesCourse::create(array(
                            'category_id' => $catIds[$i],
                            'course_id' => $course->id,
                        ));
                    }
                }
            }
            DB::commit();
            return back()->with('msg', __('messages.success_update'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('msg-error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        try {
            DB::beginTransaction();
            $course->delete();
            CategoiesCourse::getByCourseId($course->id)->delete();
            DB::commit();
            return back()->with('msg', __('messages.success_destroy'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('msg-error', $th->getMessage());
        }
    }

    private function getCategories() {
        return Category::with('subCategory')->getByParentId(0)->get();
    }
    private function getTeachers() {
        return Teacher::all();
    }
}

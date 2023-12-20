<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
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
        // dd($request->all());
        $query = Teacher::filter($request);
       
        $dataView = array(
            'page_title' => 'Quản lý giáo viên',
            'records' => $query->get(),
            'page' => $query->getPageNumber(),
            'per_page' => $query->getPerPage(),
            'total_records' => $query->getTotal()
        );
        return view('admin_page.teachers.lists', $dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataView = array(
            'page_title' => 'Thêm giáo viên mới',
        );
        return view('admin_page.teachers.create', $dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $data = $request->validated();
    
        Teacher::create($data);
        return redirect()->route('admin.teachers.index')->with('msg', __('messages.success_create'));
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
    public function edit(Teacher $teacher)
    {
        $dataView = array(
            'page_title' => 'Chỉnh sửa thông tin giáo viên',
            'item' => $teacher
        );
        return view('admin_page.teachers.edit', $dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();
        $teacher->update($data);
        return back()->with('msg', __('messages.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $isCheck = $teacher->delete();
        if ($isCheck) {
            // Xóa cả ảnh đại diện khi xóa một giáo viên, xóa cả thumbs
            $image = $teacher->image;
            $imageThumb = dirname($image).'/thumbs/'.basename($image);
            File::delete(public_path($image));
            File::delete(public_path($imageThumb));

        }
        return back()->with('msg', __('messages.success_destroy'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
            'parent_id' => 0
        );
        // Thêm dữ liệu vào trong query
        $request->merge(array_merge($queryDefault, $request->query()));
        // dd($request->all());
        $query = Category::with('subCategory')->filter($request);
        // echo '<pre>';
        // print_r($query->get()->toArray());
        // echo '</pre>'; die;
        $dataView = array(
            'page_title' => 'Quản lý danh mục',
            'records' => $query->get(),
            'page' => $query->getPageNumber(),
            'per_page' => $query->getPerPage(),
            'total_records' => $query->getTotal()
        );
        return view('admin_page.categories.lists', $dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataView = array(
            'page_title' => 'Thêm danh mục mới',
            'categories' => $this->getCategories()
        );
        return view('admin_page.categories.create', $dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
    
        Category::create(array_merge($data, array(
            'parent_id' => (int) $request->parent_id
        )));
        return redirect()->route('admin.categories.index')->with('msg', __('messages.success_create'));
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
    public function edit(Category $category)
    {
        $dataView = array(
            'page_title' => 'Chỉnh sửa thông tin danh mục',
            'categories' => $this->getCategories(),
            'item' => $category
        );
        return view('admin_page.categories.edit', $dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return back()->with('msg', __('messages.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('msg', __('messages.success_destroy'));
    }

    private function getCategories() {
        return Category::all();
    }

}

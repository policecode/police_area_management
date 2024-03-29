<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Country;
use App\Enums\Gender;
use App\Exports\TouristExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\TouristRequest;
use App\Imports\TouristImport;
use App\Models\Tourist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\FileCsv;
use Maatwebsite\Excel\Facades\Excel;

class TouristController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->per_page ? $request->per_page : 20;
        $queryDefault = array(
            'per_page' => $per_page,
        );
        // Thêm dữ liệu vào trong query
        $request->merge($queryDefault);
        $query = Tourist::filter($request);
        // DB::enableQueryLog();
        // echo $query->getTotal();
        // dd(DB::getQueryLog());
        $country = array_map(function ($item) {
            return (array)$item;
        }, Country::getInstances());
        $dataView = array(
            'page_title' => 'Quản lý người nước ngoài',
            'records' => $query->get(),
            'page' => $query->getPageNumber(),
            'per_page' => $query->getPerPage(),
            'total_records' => $query->getTotal(),
            'country' => $country,
        );
        return view('admin_page.tourists.lists', $dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = array_map(function ($item) {
            return (array)$item;
        }, Country::getInstances());
        $dataView = array(
            'page_title' => 'Thêm người nước ngoài mới',
            'gender' => Gender::getValues(),
            'country' => $country,
        );
        return view('admin_page.tourists.create', $dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TouristRequest $request)
    {
        $data = $request->validated();
       $data['user_id'] = Auth::user()->id;
       Tourist::create($data);
       return redirect()->route('admin.tourists.index')->with('msg', __('messages.success_create'));
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
    public function edit(Tourist $tourist)
    {
        $country = array_map(function ($item) {
            return (array)$item;
        }, Country::getInstances());
        $dataView = array(
            'page_title' => 'Chỉnh sửa thông tin người nước ngoài',
            'item' => $tourist,
            'gender' => Gender::getValues(),
            'country' => $country,
        );
        return view('admin_page.tourists.edit', $dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TouristRequest $request, Tourist $tourist)
    {
        $data = $request->validated();
        $tourist->update($data);
        return back()->with('msg', __('messages.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tourist $tourist)
    {
        $tourist->delete();
        return back()->with('msg', __('messages.success_destroy'));
    }
    public function export(Request $request)
    {
        return Excel::download(new TouristExport, 'list-tourist.xlsx');
        // return back()->with('msg', __('Thêm dữ liệu thành công'));
    }
    public function import(Request $request) {
        Excel::import(new TouristImport, $request->file('file_import'));
        return 'Import success';
    }
}

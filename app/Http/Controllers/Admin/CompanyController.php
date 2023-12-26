<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Emterprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
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
        $query = Emterprise::filter($request);
        // echo '<pre>';
        // print_r($query->get()->toArray());
        // echo '</pre>'; die;
        $dataView = array(
            'page_title' => 'Quản lý doanh ngiệp',
            'records' => $query->get(),
            'page' => $query->getPageNumber(),
            'per_page' => $query->getPerPage(),
            'total_records' => $query->getTotal()
        );
        return view('admin_page.companies.lists', $dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataView = array(
            'page_title' => 'Thêm doanh nghiệp mới',
        );
        return view('admin_page.companies.create', $dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        Emterprise::create($data);
        return redirect()->route('admin.companies.index')->with('msg', __('messages.success_create'));
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
    public function edit(Emterprise $company)
    {
        $dataView = array(
            'page_title' => 'Chỉnh sửa thông tin công ty',
            'item' => $company
        );
        return view('admin_page.companies.edit', $dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Emterprise $company)
    {
        $data = $request->validated();
        $company->update($data);
        return back()->with('msg', __('messages.success_update'));
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

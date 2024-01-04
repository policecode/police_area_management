<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Business as EnumsBusiness;
use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessRequest;
use App\Models\Business;
use App\Models\Emterprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
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
        $query = Business::filter($request);
        // echo '<pre>';
        // print_r($query->get()->toArray());
        // echo '</pre>'; die;
        $dataView = array(
            'page_title' => 'Quản lý các địa điểm kinh doanh',
            'records' => $query->get(),
            'page' => $query->getPageNumber(),
            'per_page' => $query->getPerPage(),
            'total_records' => $query->getTotal()
        );
        return view('admin_page.businesses.lists', $dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataView = array(
            'page_title' => 'Thêm địa điểm kinh doanh mới',
            'type' => EnumsBusiness::getValues(),
            'emterprises' => Emterprise::getSelect2()->get()
        );
        return view('admin_page.businesses.create', $dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessRequest $request)
    {
       $data = $request->validated();
       $data['user_id'] = Auth::user()->id;
       Business::create($data);
       return redirect()->route('admin.businesses.index')->with('msg', __('messages.success_create'));
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
    public function edit(Business $business)
    {
        $dataView = array(
            'page_title' => 'Chỉnh sửa thông tin địa điểm kinh doanh',
            'item' => $business,
            'type' => EnumsBusiness::getValues(),
            'emterprises' => Emterprise::getSelect2()->get()
        );
        return view('admin_page.businesses.edit', $dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BusinessRequest $request, Business $business)
    {
        $data = $request->validated();
        $business->update($data);
        return back()->with('msg', __('messages.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        $business->delete();
        return back()->with('msg', __('messages.success_destroy'));
    }
}

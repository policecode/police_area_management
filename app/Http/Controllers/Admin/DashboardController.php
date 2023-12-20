<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $dataView = array(
            'page_title' => 'Trang tổng quan'   
        );
        return view('admin_page.dashboard.lists', $dataView);;
    }
}

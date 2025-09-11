<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
      
        $dataView = array(
            'page_title' => 'Trang tổng quan'
        );
        return view('admin_page.dashboard.lists', $dataView);;
    }


}

<?php

use App\Models\Category;
use Carbon\Carbon;
define('FVN_VERSION_LARAVEL', '1.0.0');

function get_all_categories() {
    if (session('fvn_categories')) {
        return session('fvn_categories', []);
    }
    session(['fvn_categories' => Category::orderBy('name', 'ASC')->get()->toArray()]);
    return session('fvn_categories', []);
}

function dateFormat($dateTime, $format='d/m/Y H:i:s') {
    return date( $format, strtotime($dateTime));
    // return Carbon::parse($dateTime)->format('d/m/Y H:i:s');
}

function currency_format($number, $suffix = 'đ') {
    if (!empty($number)) {
        return number_format($number, 0, ',', '.') . "{$suffix}";
    }
}

/**
 * Lấy đường dẫn hiện tại và loại bỏ thành phần query chỉ định
 */
function getUrl($exeptQuery) {
    $currentUrl = url()->current().'?';
    $query_arr = $_GET;
    $index = 0;
    foreach ($query_arr as $key => $value) {
        if (!in_array($key, $exeptQuery)) {
            if ($index == 0) {
                $currentUrl .= $key.'='.$value;
            } else {
                $currentUrl .= '&'.$key.'='.$value;
            }
            $index++;
        }
    }
    return $currentUrl;
}

function getQuery($name='', $default = '') {
    if ($name) {
        if (!empty($_GET[$name])) {
            return $_GET[$name];
        }
        return $default;
    }
    return $_GET;
}

function get_string_after_time($after_minutes) {
    if ($after_minutes < 60) {
        return $after_minutes.' phút trước';
    } else if ($after_minutes < 3600) {
        return floor($after_minutes/60).' giờ trước';
    } else {
        return floor($after_minutes/(60*24)).' ngày trước';

    }
}

function get_key_by_day($name='date') {
    $now = Carbon::now();
    if ($name=='date') {
        $key = $now->year.$now->month.$now->day;
        return (int) $key;
    }
    if ($name=='week') {
        $key = $now->year.$now->weekOfYear;
        return (int) $key;
    }
    if ($name=='month') {
        $key = $now->year.$now->month;
        return (int) $key;
    }
}
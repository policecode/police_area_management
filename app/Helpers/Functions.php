<?php

use App\Models\Category;
use Carbon\Carbon;
define('FVN_VERSION_LARAVEL', '1.0.0');

function get_all_categories() {
    if (session('fvn_categories')) {
        return session('fvn_categories', []);
    }
    session(['fvn_categories' => Category::get()->toArray()]);
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

function create_slug($string)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array('a','e','i','o','u','y','d','A','E','I','O','U','Y','D','-',);
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
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
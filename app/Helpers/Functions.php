<?php

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

define('FVN_VERSION_LARAVEL', '1.0.8');

function get_all_categories($type = 1)
{
    $categories = [];
    if (session('fvn_categories') && !empty(session('fvn_categories')[$type][0])) {
        $categories = session('fvn_categories', []);
    } else {
        $tmpCat = Category::orderBy('name', 'ASC')->get()->toArray();
        foreach ($tmpCat as $key => $item) {
            if (empty($categories[$item['type']])) {
                $categories[$item['type']] = [];
            }
            $categories[$item['type']][] = $item;
            session(['fvn_categories' => $categories]);
        }
    }
    return empty($categories[$type]) ? [] : $categories[$type];
}

function dateFormat($dateTime, $format = 'd/m/Y H:i:s')
{
    return date($format, strtotime($dateTime));
    // return Carbon::parse($dateTime)->format('d/m/Y H:i:s');
}

function currency_format($number, $suffix = 'đ')
{
    if (!empty($number)) {
        return number_format($number, 0, ',', '.') . "{$suffix}";
    }
}

/**
 * Lấy đường dẫn hiện tại và loại bỏ thành phần query chỉ định
 */
function getUrl($exeptQuery)
{
    $currentUrl = url()->current() . '?';
    $query_arr = $_GET;
    $index = 0;
    foreach ($query_arr as $key => $value) {
        if (!in_array($key, $exeptQuery)) {
            if ($index == 0) {
                $currentUrl .= $key . '=' . $value;
            } else {
                $currentUrl .= '&' . $key . '=' . $value;
            }
            $index++;
        }
    }
    return $currentUrl;
}

function getQuery($name = '', $default = '')
{
    if ($name) {
        if (!empty($_GET[$name])) {
            return $_GET[$name];
        }
        return $default;
    }
    return $_GET;
}

function get_string_after_time($after_minutes)
{
    if ($after_minutes < 60) {
        return $after_minutes . ' phút trước';
    } else if ($after_minutes < 60 * 24) {
        return floor($after_minutes / 60) . ' giờ trước';
    } else if ($after_minutes < 60 * 24 * 30) {
        return floor($after_minutes / (60 * 24)) . ' ngày trước';
    } else if ($after_minutes < 60 * 24 * 30 * 365) {
        return floor($after_minutes / (60 * 24 * 30)) . ' tháng trước';
    } else {
        return floor($after_minutes / (60 * 24 * 30 * 365)) . ' năm trước';
    }
}

function get_key_by_day($name = 'date', $time = null)
{
    $now = Carbon::now();
    if ($time) {
        $now = new Carbon($time);
    }
    if ($name == 'date') {
        $key = $now->year . $now->month . $now->day;
        return (int) $key;
    }
    if ($name == 'week') {
        $key = $now->year . $now->weekOfYear;
        return (int) $key;
    }
    if ($name == 'month') {
        $key = $now->year . $now->month;
        return (int) $key;
    }
}

function downloadImageFromUrl($imageUrl, $savePath)
{
    // 1. Tải nội dung hình ảnh
    $response = Http::get($imageUrl);

    if ($response->successful()) {
        // 2. Lấy nội dung file
        $contents = $response->body();

        $filename = Str::random(20) . '.jpg';

        // 4. Lưu vào thư mục 'storage/app/public/images'
        $path = $savePath . $filename;
        Storage::disk()->put($path, $contents);

        return $path;
    }

    return false;
}

function handleFixSpellingErrors($string)
{
    $arrFix = [];
    $path_fix = public_path('/danh_sach_loi.txt');
    $file = fopen($path_fix, "r");

    while (!feof($file)) {
        $line = fgets($file);
        $tmpArr = explode(',', $line);
        $arrFix[trim($tmpArr[0])] = trim($tmpArr[1]);
        // Xử lý từng dòng ở đây để tiết kiệm bộ nhớ
    }
    fclose($file);
    foreach ($arrFix as $wrong => $correct) {
        $string = Str::replace($wrong, $correct, $string);
    }
    return $string;
}

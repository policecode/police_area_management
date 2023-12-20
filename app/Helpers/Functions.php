<?php

use Carbon\Carbon;

function getCategories($categories, $old='', $current='', $parent_id=0, $char='') {
    if ($categories) {
        foreach ($categories as $key => $category) {
            if (($category->parent_id == $parent_id) && ($category->id != $current)) {
               $tmp = '<option value="'.$category->id.'"';
               if ($category->id == $old) {
                $tmp .= ' selected';
               }
               $tmp .= ' >'.$char.$category->name.'</option>';
               echo $tmp;
               unset($categories[$key]);
               getCategories($categories,$old, $current, $category->id, $char.'|--');
            }
        }
    }
}

function renderCheckboxCategories($categories, $checkeddArr=array(), $parent_id=0, $char='') {
        $html = '';
        if (count($categories) > 0) {
            $html .= ($parent_id == 0)?'<div class="row">':'';
            foreach ($categories as $key => $category) {
                $html .= ($parent_id == 0)?'<div class="col-3">':'';
                $html .= '<div class="custom-control custom-checkbox">';
                $html .=  $char;
                $html .= '<input name="categories[]" type="checkbox" class="custom-control-input" id="'.$category->id.'" value="'.$category->id.'" ';
                if (in_array($category->id, $checkeddArr)) {
                    $html .= 'checked';
                }
                $html .= '/><label class="custom-control-label" for="'.$category->id.'">'.$category->name.'</label>';
                $html .= '</div>';
                if (count($category->subCategory) > 0) {
                    $html .= renderCheckboxCategories($category->subCategory, $checkeddArr, $category->id, $char.'<span style="margin-left: 20px"></span>');
                }
                $html .= ($parent_id == 0)?'</div>':'';
            }
            $html .= ($parent_id == 0)?'</div>':'';
        }
        return $html;
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
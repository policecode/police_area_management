<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->validationData());

        $course = $this->route()->course;
        $rules = [
            'name' => 'required|max:255|unique:courses,name',
            'slug' => 'required|max:255|unique:courses,slug',
            'detail' => 'required',
            'teacher_id' => ['required', 'integer', function($attr, $value, $fail) {
                if ($value == 0) {
                    $fail('Vui lòng chọn giáo viên');
                }
            }],
            'thumbnail' => 'required|max:255',
            'code' => ['required', 'max:255', 'unique:courses,code'],
            'is_document' => 'required|integer',
            'supports' => 'required',
            'status' => 'required|integer',
            'price' => '',
            'sale_price' => '',
            'durations' => '',
            'categories' => ''
        ];
        if ($course) {
            $rules['name'] = 'required|max:200|unique:courses,name,'.$course->id;
            $rules['slug'] = 'required|max:200|unique:courses,slug,'.$course->id;
            $rules['code'] = ['required', 'max:255', 'unique:courses,code,'.$course->id];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute phải từ :min ký tự',
            'max' => ':attribute không được lớn hơn :max ký tự',
            'integer' => ':attribute phải là số'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên nhóm',
            'slug' => 'Slug',
            'detail' => 'Nội dung',
            'teacher_id' => 'Giảng viên',
            'code' => 'Mã khóa học',
            'thumbnail' => 'Ảnh đại diện',
            'is_document' => 'Tài liệu đính kèm',
            'supports' => 'Hỗ trợ',
            'status' => 'Trạng thái',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
        $teacher = $this->route()->teacher;
        // dd($this->route()->teacher);
        $rules = [
            'name' => 'required|max:255|unique:teachers,name',
            'slug' => 'required|max:255|unique:teachers,slug',
            'description' => 'required',
            'exp' => 'required|integer',
            'image' => 'max:255',
        ];
        if ($teacher) {
            $rules['name'] = 'required|max:200|unique:teachers,name,' . $teacher->id;
            $rules['slug'] = 'required|max:200|unique:teachers,slug,' . $teacher->id;
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
            'name' => 'Tên giáo viên',
            'slug' => 'Slug',
            'description' => 'Nội dung',
            'ext' => 'Năm kinh nghiệm',
            'image' => 'Ảnh đại diện',
        ];
    }
}

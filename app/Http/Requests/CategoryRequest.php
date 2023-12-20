<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $category = $this->route()->category;
        $rules = [
            'name' => 'required|max:200|unique:categories,name',
            'slug' => 'required|max:200|unique:categories,slug',
            'parent_id' => 'required|integer'
        ];
        if ($category) {
            $rules['name'] = 'required|max:200|unique:categories,name,'.$category->id;
            $rules['slug'] = 'required|max:200|unique:categories,slug,'.$category->id;
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
            'parent_id' => 'Nhóm cha'
        ];
    }
}

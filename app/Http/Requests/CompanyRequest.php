<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $company = $this->route()->company;
        if ($company) {
            $user = Auth::user();
            if ($company->user_id == $user->id) {
                return true;
            }
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $company = $this->route()->company;
        $rules = [
            'name' => 'required|max:255|unique:emterprises,name',
            'slug' => 'required|max:255|unique:emterprises,slug',
            'code' => 'required|max:255|unique:emterprises,code',
            'boss' => '',
            'address' => '',
            'note' => '',
            'album' => '',

        ];
        if ($company) {
            $rules['name'] = 'required|max:200|unique:emterprises,name,' . $company->id;
            $rules['slug'] = 'required|max:200|unique:emterprises,slug,' . $company->id;
            $rules['code'] = 'required|max:200|unique:emterprises,code,' . $company->id;
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
            'name' => 'Tên công ty',
            'slug' => 'Slug',
            'code' => 'Mã doanh nghiệp',
            'boss' => 'Tên giám đốc',
            'address' => 'Địa chỉ',
            'note' => 'Ghi chú',
            'album' => 'Hình ảnh',
        ];
    }
}

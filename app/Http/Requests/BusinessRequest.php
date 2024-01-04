<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BusinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $business = $this->route()->business;
        if ($business) {
            $user = Auth::user();
            if ($business->user_id == $user->id) {
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
        $business = $this->route()->business;
        $rules = [
            'name' => 'required|max:255|unique:businesses,name',
            'slug' => 'required|max:255|unique:businesses,slug',
            'address' => '',
            'type' => ['integer', function($attr, $value, $fail) {
                if ($value == 0) {
                    $fail('Vui lòng chọn loại hình kinh doanh');
                }
            }],
            'emterprises_id' => 'exists:emterprises,id',
            'note' => '',
            'manager' => '',
        ];
        if ($business) {
            $rules['name'] = 'required|max:200|unique:emterprises,name,' . $business->id;
            $rules['slug'] = 'required|max:200|unique:emterprises,slug,' . $business->id;
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
            'integer' => ':attribute phải là số',
            'exists' => ':attribute không tồn tại'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên công ty',
            'slug' => 'Slug',
            'type' => 'Loại hình',
            'manager' => 'Quản lý',
            'address' => 'Địa chỉ',
            'note' => 'Ghi chú',
            'emterprises_id' => 'Doanh nghiệp',
        ];
    }
}

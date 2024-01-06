<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TouristRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $tourist = $this->route()->tourist;
        if ($tourist) {
            $user = Auth::user();
            if ($tourist->user_id == $user->id) {
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
        $tourist = $this->route()->tourist;
        $rules = [
            'name' => 'required|max:255|unique:tourists,name',
            'slug' => 'required|max:255|unique:tourists,slug',
            'birthday' => '',
            'gender' => ['integer', function($attr, $value, $fail) {
                if ($value == 0) {
                    $fail('Vui lòng chọn giới tính');
                }
            }],
            'country' => [ function($attr, $value, $fail) {
                if ($value == '0') {
                    $fail('Vui lòng chọn quốc tịch');
                }
            }],
            'note' => '',
            'passport' => 'required',
            'album' => ''
        ];
        if ($tourist) {
            $rules['name'] = 'required|max:200|unique:tourists,name,' . $tourist->id;
            $rules['slug'] = 'required|max:200|unique:tourists,slug,' . $tourist->id;
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
            'birthday' => 'Ngày sinh',
            'gender' => 'Giới tính',
            'country' => 'Quốc tịch',
            'note' => 'Ghi chú',
            'passport' => 'Hộ chiếu',
            'album' => 'Thư viện ảnh'
        ];
    }
}

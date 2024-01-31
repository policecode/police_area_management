<?php

namespace App\Exports;

use App\Enums\Country;
use App\Enums\Gender;
use App\Models\Tourist;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TouristExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private $userCollection = array();
    public function __construct()
    {
        $this->userCollection = User::all();
    }
    /**
    * @return \Illuminate\Support\Collection
    * Xác định Model thực hiện thao tác
    */
    public function collection()
    {
        return Tourist::all();
    }
    /**
     * Tiêu đề cho từng cột
     */
    public function headings(): array {
        return [
          '#',
          'Tài khoản tạo',
          'Họ tên',
          'Ngày, tháng, năm sinh',
          'Giới tính',
          'Quốc gia',
          'Số hộ chiếu',
        ];
    }
    /**
     * Giá trí cho từng cột
     */
    public function map($tourist): array
    {
        $userEmail = '';
        $tmpListUser = $this->userCollection->filter(function ($item, $index) use ($tourist) {
            return $item['id'] == $tourist->user_id;
        });
        if ($tmpListUser->count() > 0) {
            $userEmail = $tmpListUser[0]->email;
        }
        
        $enumsGenderArr = Gender::getValues();
        $gender = '';
        foreach ($enumsGenderArr as $key => $enum) {
            if ($enum['key'] == $tourist->gender) {
                $gender = $enum['value'];
                break;
            }
        }
        
      return [
          $tourist->id,
          $userEmail,
          $tourist->name,
          dateFormat($tourist->birthday, 'd/m/Y'),
          $gender,
          Country::fromKey($tourist->country),
          $tourist->passport,
      ];
    }
    /**
     * Căn chỉnh chiều rộng cho từng cột
     */
}

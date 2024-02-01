<?php

namespace App\Imports;

use App\Models\Tourist;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class TouristImport implements ToModel, WithHeadingRow, WithUpserts 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /**
         * String birthday: 01/09/1995
         */
        $dateArr = explode('/', $row['birthday']);
        $date = Carbon::create($dateArr[2], $dateArr[1], $dateArr[0]);
        // echo '<pre>';
        // print_r($row);
        // echo '</pre>'; die;
        return new Tourist([
            'user_id' => $row['user_id'],
            'name' => $row['name'],
            'slug' => create_slug($row['name']),
            'birthday' => $date,
            'gender' => $row['gender'],
            'country' => $row['country'],
            'passport' => $row['passport'],

        ]);
    }
    /**
     * Ko sử dụng được, tính năng unique table
     */
    public function uniqueBy()
    {
        return ['name'];
    }
}

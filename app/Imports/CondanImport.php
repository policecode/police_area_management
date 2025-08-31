<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas; //Kết quả trả về chuỗi đã tính toán của các ô excel
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CondanImport implements ToCollection, WithCalculatedFormulas, WithColumnFormatting, WithChunkReading
{
    public $processed = [];
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
         foreach ($rows as $row) {
            $rowArray = $row->toArray();
            if (!empty($rowArray[2]) && is_numeric($rowArray[2])) {
                $rowArray[2] = Date::excelToDateTimeObject($rowArray[2])->format('d/m/Y');
            }
            if (!empty($rowArray[9]) && is_numeric($rowArray[9])) {
                $rowArray[9] = Date::excelToDateTimeObject($rowArray[9])->format('d/m/Y');
            }
            // CCCD
             if (!empty($rowArray[5])) {
                // Ép về chuỗi & pad đủ 12 ký tự bằng số 0
                $rowArray[5] = str_pad((string)$rowArray[5], 12, "0", STR_PAD_LEFT);
            }
            $this->processed[] = $rowArray;
        }
    }

    public function chunkSize(): int
    {
        return 1000; // Đọc 1000 row một lần
    }

    public function columnFormats(): array
    {
        return [

            // 'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,        
        ];
    }
}

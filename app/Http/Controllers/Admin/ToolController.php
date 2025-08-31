<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CondanImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
class ToolController extends Controller
{
    public function readExcel() {
        $file = Storage::path('excel_file/form.xlsx');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        // Lấy dữ liệu từ file cũ
        $data = $sheet->toArray();
        // foreach ($data as $key => $row) {
        //     if ($key != 0) {

        //     }
        // }
        return Excel::download(
            new class($data) implements \Maatwebsite\Excel\Concerns\FromArray {
                private $data;
                public function __construct(array $data) { $this->data = $data; }
                public function array(): array { return $this->data; }
            },
            'new_file.xlsx'
        );
    }


     public function readExcelv2() {
        $file = Storage::path('excel_file/CDTL2025.xlsx');
        $import = new CondanImport;
        Excel::import($import, $file);
        // return $import->processed;
        return Excel::download(
            new class($import->processed) implements \Maatwebsite\Excel\Concerns\FromArray {
                private $data;
                public function __construct(array $data) { $this->data = $data; }
                public function array(): array { return $this->data; }
            },
            'new_file.xlsx'
        );
    }
}

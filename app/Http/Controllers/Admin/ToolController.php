<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CondanImport;
use App\Models\CoppyrightStory;
use App\Models\OrderChapter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function handleStoryCopyright() {
        DB::beginTransaction();
        try {
            $storyCopyrights = OrderChapter::select(
                        'user_id', 
                        'story_id', 
                        DB::raw('SUM(money) as total_money'),
                        DB::raw('COUNT(chapter_id) as total_chapters'),
                        DB::raw('MAX(created_at) as last_order_time')
                    )
                    ->groupBy('user_id', 'story_id')
                    ->orderBy('last_order_time', 'desc')
                    ->get();
            foreach ($storyCopyrights as $item) {
                $check = CoppyrightStory::GetByUser($item->user_id)->GetByStory($item->story_id)->first();
                if (!$check) {
                    CoppyrightStory::create([
                        'user_id' => $item->user_id,
                        'story_id' => $item->story_id,
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => $storyCopyrights,
                'message' => 'Xử lý thành công'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Lỗi xử lý dữ liệu: ' . $e->getMessage()], 500);
        }
    }
}

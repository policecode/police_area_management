<?php

namespace App\Traits;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

trait FileWord
{
    public function exportDocx()
    {
        // 1. Khởi tạo đối tượng PHPWord
        $phpWord = new PhpWord();

        // 2. Tạo một Section (một trang/phần của văn bản)
        $section = $phpWord->addSection();

        // 3. Thêm nội dung văn bản
        $section->addTitle('Xin chào từ Laravel!', 1);
        $section->addText('Đây là file .docx được tạo tự động bởi Đối tác lập trình.');

        // Thêm một đoạn văn với định dạng riêng
        $fontStyle = ['bold' => true, 'italic' => true, 'size' => 14];
        $section->addText('Đoạn văn này được in đậm và in nghiêng.', $fontStyle);

        // 4. Lưu file vào bộ nhớ đệm (Temporary file)
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = 'Document_HuongDan.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'phpword');
        $objWriter->save($tempFile);

        // 5. Trả về phản hồi để trình duyệt tự động tải xuống
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}

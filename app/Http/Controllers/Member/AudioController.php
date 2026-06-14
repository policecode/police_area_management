<?php

namespace App\Http\Controllers\Member;

use App\Enums\AudioStatus;
use App\Http\Controllers\Controller;
use App\Models\AudioChapter;
use App\Models\Chaper;
use App\Models\Story;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\ExecutableFinder;
use Illuminate\Support\Facades\Log;

class AudioController extends Controller
{
    public function generateAudio(Request $request)
    {
        $audioChapters = AudioChapter::JoinChapter()->GetByStatus(AudioStatus::PENDING['key'])->limit(50)->get();
        // - Khởi tạo bộ tìm kiếm file thực thi của hệ thống
        $executableFinder = new ExecutableFinder();
        // - Ưu tiên tìm lệnh 'python3' trước, nếu không thấy thì tìm lệnh 'python'
        $pythonBinary = $executableFinder->find('python3') ?? $executableFinder->find('python');

        // - Phòng trường hợp server hoàn toàn chưa cài Python
        if (!$pythonBinary) {
            throw new \Exception('Hệ thống chưa cài đặt Python hoặc chưa cấu hình biến môi trường (Environment Path).');
        }

        foreach ($audioChapters as $audio) {
            try {
                // 1. Lấy text từ client gửi lên (hoặc lấy từ database truyện của bạn)
                $story = Story::find($audio->story_id);
                $content = $audio->content;
                $text = handleFixSpellingErrors($content);
                $text = Str::replace(["\n", "\r\n", "\r", "</p>", "<br>", "<br />", "<br/>"], ' ', $text);
                $text = strip_tags($text);
                // 2. Tạo tên file audio và file text tạm
                if (!Storage::disk('public')->exists('audio')) {
                    Storage::disk('public')->makeDirectory('audio');
                }
                $audioName = $audio->slug . '.mp3';
                $textTempName = $audio->slug . '.txt';

                $absoluteOutputPath = storage_path('app/public/audio/' . $audioName);
                if (File::exists($absoluteOutputPath)) {
                    File::delete($absoluteOutputPath);
                }
                // Đường dẫn file text tạm để truyền cho Python đọc
                $absoluteTextPath = storage_path('app/public/audio/' . $textTempName);
                // 3. Ghi dữ liệu text vào file tạm (Xử lý được mọi loại dấu ngoặc kép, xuống dòng)
                File::put($absoluteTextPath, $text);

                // 4. Đường dẫn tới file Python script
                $scriptPath = storage_path('app/scripts/tts.py');

                // 5. Khởi tạo Process: Bây giờ ta truyền ĐƯỜNG DẪN FILE TEXT chứ không truyền chuỗi text nữa

                // $process = new Process(['python', $scriptPath, $absoluteTextPath, $absoluteOutputPath]); //trên local
                $process = new Process([$pythonBinary, $scriptPath, $absoluteTextPath, $absoluteOutputPath]); //trên server
                $process->setTimeout(null); // Tắt timeout
                // 6. Kích hoạt chạy
                $process->run();

                // 7. Xóa file text tạm sau khi Python đã xử lý xong để sạch bộ nhớ server
                if (File::exists($absoluteTextPath)) {
                    File::delete($absoluteTextPath);
                }

                // 8. Kiểm tra lỗi
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                    // $errorOutput = $process->getErrorOutput();
                    // dd($errorOutput); // Dừng hệ thống và in ra lỗi chi tiết
                }

                // ================= TIẾN TRÌNH ĐẨY LÊN CLOUD R2 =================
                $r2AudioUrl = null;

                if (File::exists($absoluteOutputPath)) {
                    // 1. Đọc file mp3 vừa được Python tạo ra dưới dạng stream dữ liệu
                    $fileStream = fopen($absoluteOutputPath, 'r+');

                    // 2. Đường dẫn thư mục bạn muốn lưu trên Cloudflare R2 (Ví dụ: danh_muc_audio/file.mp3)
                    $r2Path = 'audio-stories/' . $story->slug . '/' . $audioName;

                    // 3. Đẩy tự động lên Cloudflare R2, cấu hình quyền public-read để client bật link nghe được luôn
                    Storage::disk('r2')->put($r2Path, $fileStream, [
                        'visibility' => 'public',
                        'ContentType' => 'audio/mp3'
                    ]);

                    // Đóng stream sau khi hoàn tất
                    if (is_resource($fileStream)) {
                        fclose($fileStream);
                    }

                    // 4. Xóa luôn file .mp3 tạm trên server Laragon để dọn sạch ổ cứng của bạn
                    File::delete($absoluteOutputPath);

                    // 5. Sinh ra đường link trực tiếp (Direct Link) từ Cloudflare R2
                    $r2AudioUrl = env('CLOUDFLARE_R2_URL') . '/' . $r2Path;
                    $process = new Process([$pythonBinary, storage_path('app/scripts/get_info.py'), $r2AudioUrl]);
                    $process->setTimeout(30);
                    $process->run();

                    if ($process->isSuccessful()) {
                        $result = json_decode($process->getOutput(), true);
                        $fileSize = $result['size'];       // Dung lượng (Bytes)
                        $duration = $result['duration'];   // Thời lượng (Giây)
                    }
                    $audio->update([
                        'file_path' => $r2AudioUrl,
                        'file_size' => $fileSize,
                        'duration' => $duration,
                        'status' => AudioStatus::SUCCESS['key']
                    ]); // Cập nhật trạng thái thành "Đang xử lý" để tránh trùng lặp khi có nhiều tiến trình cùng chạy
                    dd($result);
                } else {
                    Log::error('Xử lý tạo file: Không tìm thấy file audio tạm thời để tải lên Cloud.');
                }
            } catch (\Exception $e) {
                Log::error('Xử lý tạo file: ' . $audio->name . ' - ' . $e->getMessage());
                continue; // Bỏ qua chương này và tiếp tục với chương tiếp theo
            }

            // ===============================================================


        }
    }
}

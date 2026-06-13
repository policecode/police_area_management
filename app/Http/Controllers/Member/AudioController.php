<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Chaper;
use App\Models\Story;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\ExecutableFinder;

class AudioController extends Controller
{
    public function generateAudio(Request $request)
    {
        // - Khởi tạo bộ tìm kiếm file thực thi của hệ thống
        $executableFinder = new ExecutableFinder();
        // - Ưu tiên tìm lệnh 'python3' trước, nếu không thấy thì tìm lệnh 'python'
        $pythonBinary = $executableFinder->find('python3') ?? $executableFinder->find('python');

        // - Phòng trường hợp server hoàn toàn chưa cài Python
        if (!$pythonBinary) {
            throw new \Exception('Hệ thống chưa cài đặt Python hoặc chưa cấu hình biến môi trường (Environment Path).');
        }
        // 1. Lấy text từ client gửi lên (hoặc lấy từ database truyện của bạn)
        $story = Story::GetBySlug('cau-tai-vo-dao-the-gioi-thanh-thanh')->first();
        $chapters = Chaper::getByStory($story->id)->GetByPosition(1)->first();
        $content = $chapters->content;
        $text = handleFixSpellingErrors($content);
        $text = strip_tags($text);
        $text = Str::replace(["\n", "\r\n", "\r"], ' ', $text);
        // $text = $request->input('text', 'Hàn Lập khẽ cau mày, lấy ra một viên đan dược.');
        // return response()->json([
        //     'success' => true,
        //     'message' =>  $text
        // ]);
        // 2. Tạo tên file audio và file text tạm
        if (!Storage::disk('public')->exists('audio')) {
            Storage::disk('public')->makeDirectory('audio');
        }
        $audioName = 'tmpAudio.mp3';
        $textTempName = 'tmpAudio.txt';

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
        $audioUrl = Storage::url('audio/' . $audioName);

        // Trả về dữ liệu JSON cho client gọi Ajax/Fetch trên giao diện nhận được
        return response()->json([
            'success' => true,
            'message' => 'Tạo âm thanh thành công!',
            'audio_url' => asset($audioUrl) // Trả về link tuyệt đối: http://domain.com/storage/audio/xxx.mp3
        ]);

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
        } else {
            return response()->json(['success' => false, 'error' => 'Không tìm thấy file audio tạm thời để tải lên Cloud.'], 500);
        }
        // ===============================================================

        // Trả link đám mây về cho client thưởng thức, link này có dạng: https://pub-xxx.r2.dev/audio_stories/chuong_123.mp3
        return response()->json([
            'success' => true,
            'audio_url' => $r2AudioUrl
        ]);
    }
}

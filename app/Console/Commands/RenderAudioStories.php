<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RenderAudioStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'audio:render';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tạo các file audio từ lựa chọn của độc giả';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Ghi log vào file storage/logs/laravel.log để kiểm tra
        Log::info('--- BẮT ĐẦU chạy tiến trình render âm thanh ---');

        try {
            // Logic xử lý của bạn ở đây...
            // Ví dụ: Xử lý chuyển văn bản thành giọng nói, render audio...

            // Giả lập thời gian chạy mất 15 giây
            sleep(15);

            Log::info('--- KẾT THÚC tiến trình render âm thanh thành công! ---');
        } catch (\Exception $e) {
            Log::error('Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}

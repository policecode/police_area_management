<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudioChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_chapters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chapter_id')->unique();
            $table->string('file_path')->nullable(); // Đường dẫn file audio
            $table->integer('file_size')->nullable(); // Thống kê dung lượng
            $table->integer('duration')->nullable();  // Thời lượng tính bằng giây
            // Trạng thái để xử lý hàng đợi (Queue) nếu chạy TTS ngầm
            $table->tinyInteger('status')->default(1); 
            $table->integer('listen_count')->default(0); // Lượt nghe audio
            $table->timestamps();
        });
         Schema::table('users', function (Blueprint $table) {
             $table->integer('total_audio')->default(0)->after('total_chapter');
        });

        Schema::table('stories', function (Blueprint $table) {
             $table->integer('listen_count')->default(0)->after('view_count');
            $table->bigInteger('last_audio_id')->after('chaper_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_chapters');
         Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('total_audio');
        });
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('listen_count');
            $table->dropColumn('last_audio_id');
        });
    }
}

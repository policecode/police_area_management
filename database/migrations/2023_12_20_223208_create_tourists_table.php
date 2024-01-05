<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Lưu thông tin người nước ngoài
        Schema::create('tourists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->dateTime('birthday');
            $table->tinyInteger('gender');
            $table->string('country', 20)->nullable(); //Quốc tịch
            $table->string('passport', 20);
            $table->text('album')->nullable(); // Lưu trữ hình ảnh
            // $table->tinyInteger('status'); // 1 - Đang tạm trú, 2 - Không tạm trú
            $table->text('note')->nullable(); // Thông tin thêm của người nước ngoài
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tourists');
    }
}

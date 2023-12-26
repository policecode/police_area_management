<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Lưu thông tin về địa điểm kinh doanh
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('name'); //Tên địa điểm kinh doanh
            $table->string('slug');
            $table->string('address')->nullable();// Địa chỉ kinh doanh
            $table->tinyInteger('type');// Loại hình kinh doanh
            $table->integer('emterprises_id')->nullable(); // Doanh nghiệp của cơ sở kinh doanh
            $table->text('manager')->nullable();// Thông tin mô tả của người quản lý, lưu dạng json
            $table->text('note')->nullable();// Thông tin mô tả về cơ sở kinh doanh.
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
        Schema::dropIfExists('hotels');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Thông tin doanh nghiệp
        Schema::create('emterprises', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('name'); //Tên doannh nghiệp
            $table->string('slug');
            $table->string('code', 30);// Mã đăng ký kinh doanh
            $table->string('boss');// Giám đốc
            $table->string('address');// Địa chỉ trụ sở chính
            $table->text('note');// Thông tin mô tả
            $table->text('album');// Hình ảnh liên quan
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
        Schema::dropIfExists('emterprises');
    }
}

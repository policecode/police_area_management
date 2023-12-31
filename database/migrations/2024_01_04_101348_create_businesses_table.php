<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('name'); //Tên địa điểm kinh doanh
            $table->string('slug');
            $table->string('address')->nullable();// Địa chỉ kinh doanh
            $table->tinyInteger('type');// Loại hình kinh doanh
            $table->integer('emterprises_id')->nullable(); // Doanh nghiệp của cơ sở kinh doanh
            $table->text('manager')->nullable();// Thông tin mô tả của người quản lý
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
        Schema::dropIfExists('businesses');
    }
}

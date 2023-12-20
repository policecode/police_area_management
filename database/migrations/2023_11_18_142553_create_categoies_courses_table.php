<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoiesCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoies_courses', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('course_id');
            $table->timestamps();
        });

        // Thêm khóa ngoại
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoies_courses');
    }
}

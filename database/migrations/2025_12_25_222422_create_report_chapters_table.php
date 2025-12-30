<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_chapters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('story_id')->index();
            $table->bigInteger('chapter_id')->index();
            $table->string('content', 500);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('report_chapters');
    }
}

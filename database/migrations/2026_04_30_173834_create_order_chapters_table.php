<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_chapters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->integer('story_id')->index();
            $table->bigInteger('chapter_id');
            $table->smallInteger('money');
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
        Schema::dropIfExists('order_chapters');
    }
}

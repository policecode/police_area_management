<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReadStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_read_stories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('story_id')->index();
            $table->bigInteger('last_chapter_id')->nullable();
            $table->integer('story_count')->default(1);
            $table->tinyInteger('favorite')->default(2);
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
        Schema::dropIfExists('user_read_stories');
    }
}

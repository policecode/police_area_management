<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('thumbnail', 800);
            $table->text('description')->nullable();
            $table->integer('star_count')->default(0);
            $table->float('star_average', 2, 2)->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('author_id')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamp('last_chapers')->nullable();
            $table->bigInteger('chaper_id')->nullable();
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
        Schema::dropIfExists('stories');
    }
}

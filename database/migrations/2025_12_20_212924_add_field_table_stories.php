<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTableStories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->integer('total_like')->default(0);
            $table->integer('total_favorite')->default(0);
            $table->integer('total_comment')->default(0);
            $table->bigInteger('last_comment_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
              $table->dropColumn('total_like');
            $table->dropColumn('total_favorite');
            $table->dropColumn('total_comment');
             $table->dropColumn('last_comment_id');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStoriesAndChapters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         Schema::table('stories', function (Blueprint $table) {
            $table->smallInteger('buy_money')->default(0);
            $table->smallInteger('buy_position')->nullable();
            $table->integer('total_money')->default(0);

        });
        Schema::table('chapers', function (Blueprint $table) {
            $table->smallInteger('money')->default(0);
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
            $table->dropColumn('buy_money');
            $table->dropColumn('buy_position');
            $table->dropColumn('total_money');

        });

         Schema::table('chapers', function (Blueprint $table) {
            $table->dropColumn('money');
        });
    }
}

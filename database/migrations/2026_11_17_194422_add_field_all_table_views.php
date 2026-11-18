<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldAllTableViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('view_days', function (Blueprint $table) {
            $table->dropColumn('percentage');
        });
        Schema::table('view_weeks', function (Blueprint $table) {
            $table->dropColumn('percentage');
        });
        Schema::table('view_months', function (Blueprint $table) {
            $table->dropColumn('percentage');
             $table->text('users_care')->nullable(); // Các user từng đọc qua truyện trong tháng
             $table->smallInteger('total_care')->default(0); // Số lượng user từng đọc qua truyện trong tháng
             $table->smallInteger('donate')->default(0); // Số linh thạch được donate cho truyện trong tháng
        });
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('total_percentage');
            $table->bigInteger('total_donate')->default(0); // Số linh thạch truyện được donate
        });
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('total_donate')->default(0); // Số linh thạch truyện được donate
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('view_days', function (Blueprint $table) {
            $table->float('percentage')->default(0);
        });
        Schema::table('view_weeks', function (Blueprint $table) {
            $table->float('percentage')->default(0);
        });
        Schema::table('view_months', function (Blueprint $table) {
            $table->float('percentage')->default(0);
            $table->dropColumn('users_care');
            $table->dropColumn('total_care');
            $table->dropColumn('donate');
        });
        Schema::table('stories', function (Blueprint $table) {
            $table->float('total_percentage')->default(0);
            $table->dropColumn('total_donate');
        });
         Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('total_donate'); // Số linh thạch truyện được donate
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiledPercentageTableView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('view_days', function (Blueprint $table) {
            $table->float('percentage')->default(0);
        });
        Schema::table('view_weeks', function (Blueprint $table) {
            $table->float('percentage')->default(0);
        });
        Schema::table('view_months', function (Blueprint $table) {
            $table->float('percentage')->default(0);
        });
        Schema::table('stories', function (Blueprint $table) {
            $table->float('total_percentage')->default(0);
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
            $table->dropColumn('percentage');
        });
        Schema::table('view_weeks', function (Blueprint $table) {
            $table->dropColumn('percentage');
        });
        Schema::table('view_months', function (Blueprint $table) {
            $table->dropColumn('percentage');
        });
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('total_percentage');
        });
    }
}

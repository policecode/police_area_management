<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar', 500)->nullable();
            $table->string('socialite', 20)->nullable();
            $table->string('socialite_id', 50)->nullable();
            $table->bigInteger('exp')->default(0);
            $table->tinyInteger('level')->default(1);
            $table->bigInteger('money')->default(0);
            $table->integer('total_story')->default(0);
            $table->integer('total_chapter')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('socialite');
            $table->dropColumn('exp');
            $table->dropColumn('level');
            $table->dropColumn('money');
            $table->dropColumn('total_story');
            $table->dropColumn('total_chapter');

        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTableStarRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('star_ratings', function (Blueprint $table) {
            $table->string('content', 500)->default('');
            $table->dropColumn('key_date');
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
        Schema::table('star_ratings', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->integer('key_date')->nullable();
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');

        });
    }
}

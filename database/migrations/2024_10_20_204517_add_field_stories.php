<?php

use App\Models\Story;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
class AddFieldStories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->string('title_eng')->after('title')->unique()->nullable();
        });

        $stories = Story::all();
        foreach ($stories as $key => $item) {
            $item->title_eng = Str::slug($item->title, " ");
            $item->update();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('title_eng');
        });
    }
}

<?php

use App\Models\Group;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->tinyInteger('id')->autoIncrement();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('permissions');
        });
        Group::insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'slug' => 'admin',
                'permissions' => json_encode([])
            ],
            [
                'id' => 2,
                'name' => 'Author',
                'slug' => 'author',
                'permissions' => json_encode([])
            ],
            [
                'id' => 3,
                'name' => 'Reader',
                'slug' => 'reader',
                'permissions' => json_encode([])
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}

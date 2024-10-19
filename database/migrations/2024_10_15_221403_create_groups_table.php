<?php

use App\Enums\GroupRole;
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

        $groups = GroupRole::asArray();
        foreach ($groups as $key => $item) {
            $groups[$key]['permissions'] = json_encode([], JSON_UNESCAPED_UNICODE);
        }
        Group::insert($groups);
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

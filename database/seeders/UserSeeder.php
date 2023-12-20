<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'name' => 'Nguyễn Hoàng Đạt',
            'email' => 'hoangdat@gmail.com',
            'password' => bcrypt('123456789'),
            'group_id' => 1
        ));
    }
}

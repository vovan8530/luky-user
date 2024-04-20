<?php

namespace Database\Seeders;

use App\Enums\UserTypes;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::query()->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            'id' => 1,
            'type' => UserTypes::ADMIN,
            'name' => 'admin',
            'phone' => '380997856740',
            'password' => bcrypt('0000'),
        ]);

    }
}

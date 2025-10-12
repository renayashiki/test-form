<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // 検索条件
            [
                'name' => '管理者',
                'password' => Hash::make('password'), // 好きな初期パスワード
                'is_admin' => 1,
            ]
        );
    }
}

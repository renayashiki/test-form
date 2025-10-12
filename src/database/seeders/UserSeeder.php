<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 管理者アカウントのダミーデータ
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com', // 💡このメールアドレスでログイン
            'password' => bcrypt('password'), // パスワードは 'password'
            // 必要に応じて 'role' や 'is_admin' などのフラグも追加
            'is_admin' => true,
        ]);

        // （他のユーザーデータもあればここに）
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1) カテゴリを先に作る（外部キー先）
        $this->call(\Database\Seeders\CategorySeeder::class);

        // 2) 管理者ユーザーを作る
        $this->call(\Database\Seeders\AdminUserSeeder::class);

        $this->call([
            CategorySeeder::class,
            AdminUserSeeder::class,
        ]);
        
        // 3) ダミーのcontactsを作る
        \App\Models\Contact::factory(35)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            '商品のお届けについて',
            '商品交換について',
            '商品トラブル',
            'ショップへのお問い合わせ',
            'その他',
        ];

        foreach ($items as $content) {
            Category::updateOrCreate(
                ['content' => $content], // 検索条件
                ['content' => $content]  // 更新内容
            );
        }
    }
}

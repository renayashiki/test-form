<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // contacts テーブルの定義
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            // カテゴリーIDと外部キー制約（categoriesテーブルと紐づけ）
            $table->foreignId('category_id')->constrained()->cascadeOnDelete(); // ← 追記

            // 氏名・性別
            $table->string('last_name', 255); // 氏名（姓） // ← 追記
            $table->string('first_name', 255); // 氏名（名） // ← 追記
            $table->tinyInteger('gender'); // 性別（1: 男性, 2: 女性, 3: その他） // ← 追記

            // 連絡先
            $table->string('email', 255); // メールアドレス // ← 追記
            $table->string('tel', 255); // 電話番号 // ← 追記

            // 住所
            $table->string('address', 255); // 住所 // ← 追記
            $table->string('building', 255)->nullable(); // 建物名（NULL許可） // ← 追記

            // お問い合わせ内容
            $table->text('detail'); // お問い合わせ内容 // ← 追記

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
        Schema::dropIfExists('contacts');
    }
}

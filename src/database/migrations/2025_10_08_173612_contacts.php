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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            // ✅ category_idをnullableに変更
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();

            // 氏名・性別
            $table->string('last_name', 255);
            $table->string('first_name', 255);
            $table->tinyInteger('gender'); // 1:男性, 2:女性, 3:その他

            // 連絡先
            $table->string('email', 255);
            $table->string('tel', 255);

            // 住所
            $table->string('address', 255);
            $table->string('building', 255)->nullable();

            // お問い合わせ内容
            $table->text('detail');

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

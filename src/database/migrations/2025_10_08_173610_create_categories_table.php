<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // categories テーブルの定義
        Schema::create(
            'categories',
            function (Blueprint $table) {
                $table->id();
                $table->string('content', 255);
                $table->timestamps();
            }
        ); 
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // マイグレーションを元に戻す処理。ここではテーブルを削除。
        Schema::dropIfExists('categories');
    }
} 
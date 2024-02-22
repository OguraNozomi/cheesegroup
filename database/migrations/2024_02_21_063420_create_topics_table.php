<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // タイトルを保存するカラム
            $table->string('body');  // ニュースの本文を保存するカラム
            $table->string('photo_1');  // 画像のパスを保存するカラム
            $table->string('photo_2');  // 画像のパスを保存するカラム
            $table->string('photo_3');  // 画像のパスを保存するカラム
            $table->tinyInteger('release_flag')->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->string('user_name'); 
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
        Schema::dropIfExists('topics');
    }
};

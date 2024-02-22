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
        Schema::table('topics', function (Blueprint $table) {
            //
             $table->string('photo_1')->nullable(true)->change();
             $table->string('photo_2')->nullable(true)->change();
             $table->string('photo_3')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            //
            $table->string('photo_3')->nullable(false)->change();
            $table->string('photo_2')->nullable(false)->change();
            $table->string('photo_1')->nullable(false)->change();
        });
    }
};

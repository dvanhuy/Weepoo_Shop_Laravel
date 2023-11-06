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
        Schema::create('figures', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('gia');
            $table->string('so_luong_hien_con');
            $table->string('so_luong_da_ban')->default("0");
            $table->string('nha_sx')->nullable();
            $table->string('chieu_cao')->nullable();
            $table->string('chieu_rong')->nullable();
            $table->string('chat_lieu')->nullable();
            $table->string('mota')->nullable();
            $table->string('hinhanh')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('figures');
    }
};

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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('phone')->nullable();
            $table->string('role')->nullable();
            $table->string('social_id')->nullable();
            $table->string('social_type')->nullable();
            $table->string('avatar')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('phone'); 
            $table->dropColumn('role');
            $table->dropColumn('deleted_at');
        });
    }
};

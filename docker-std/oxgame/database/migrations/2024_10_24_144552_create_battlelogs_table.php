<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('battlelogs', function (Blueprint $table) {
            $table->id();
            $table->string('user1session',255)->nullable(false);
            $table->string('user2session',255)->nullable(false);
            $table->bigInteger('roomid')->nullable(false);
            $table->integer('board1')->nullable(false);
            $table->integer('board2')->nullable(false);
            $table->integer('board3')->nullable(false);
            $table->integer('board4')->nullable(false);
            $table->integer('board5')->nullable(false);
            $table->integer('board6')->nullable(false);
            $table->integer('board7')->nullable(false);
            $table->integer('board8')->nullable(false);
            $table->integer('board9')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battlelogs');
    }
};

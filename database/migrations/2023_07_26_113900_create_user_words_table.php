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
        Schema::create('user_word', function (Blueprint $table) {
            $table->ulid('id');
            $table->unsignedBigInteger('word_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_knew')->default(0);
            $table->unsignedInteger('correct_answer')->default(0);
            $table->unsignedInteger('wrong_answer')->default(0);
            $table->unsignedInteger('repeat')->default(0);
            $table->timestamps();

            $table->foreign('word_id')->references('id')->on('words')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_word');
    }
};

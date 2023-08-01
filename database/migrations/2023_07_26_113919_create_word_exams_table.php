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
        Schema::create('word_exams', function (Blueprint $table) {
            $table->ulid('id');
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('word_id');
            $table->unsignedTinyInteger('answer')->default(0);
            $table->timestamps();

            $table->foreign('exam_id')->references('id')->on('exams');
            $table->foreign('word_id')->references('id')->on('words');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_exams');
    }
};

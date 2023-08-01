<?php

use App\Enums\Database\Exam\ExamType;
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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedTinyInteger('type')->default(ExamType::Random);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('grade')->default(0);
            $table->boolean('is_timer_on')->default(true);
            $table->boolean('is_word_knew')->default(false);
            $table->boolean('is_my_words')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};

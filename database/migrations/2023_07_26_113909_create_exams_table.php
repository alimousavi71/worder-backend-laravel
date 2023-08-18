<?php

use App\Enums\Database\Exam\ExamType;
use App\Enums\Database\Exam\RepositoryType;
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
            $table->unsignedTinyInteger('type')->default(ExamType::Normal);
            $table->unsignedTinyInteger('repository')->default(RepositoryType::MyWord);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('grade')->default(0);
            $table->dateTime('end_time')->nullable();
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

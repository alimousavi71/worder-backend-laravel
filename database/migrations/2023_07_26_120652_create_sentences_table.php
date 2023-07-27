<?php

use App\Enums\Database\Sentence\SentenceStatus;
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
        Schema::create('sentences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('sentence');
            $table->text('translate');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedTinyInteger('status')->default(SentenceStatus::Pending);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sentences');
    }
};

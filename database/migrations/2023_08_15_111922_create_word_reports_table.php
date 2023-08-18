<?php

use App\Enums\Database\WordReport\EWordReportReason;
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
        Schema::create('word_reports', function (Blueprint $table) {
            $table->ulid('id');
            $table->unsignedBigInteger('word_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('reason')->default(EWordReportReason::WrongWord);
            $table->boolean('is_seen')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_reports');
    }
};

<?php

use App\Enums\Database\Contact\ERate;
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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('rate')->default(ERate::EXCELLENT)->nullable();
            $table->boolean('is_seen')->default(false);
            $table->boolean('is_public')->default(false);
            $table->boolean('is_collaboration')->default(false);
            $table->text('agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};

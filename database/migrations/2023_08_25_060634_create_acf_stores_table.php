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
        Schema::create('acf_store', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acf_connect_id');
            $table->unsignedBigInteger('acf_field_id');

            $table->text('value')->nullable();

            $table->foreign('acf_connect_id')
                ->references('id')
                ->on('acf_connects')
                ->cascadeOnDelete();

            $table->foreign('acf_field_id')
                ->references('id')
                ->on('acf_templates')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acf_store');
    }
};

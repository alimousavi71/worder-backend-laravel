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
        Schema::create('acf_connects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acf_build_id');
            $table->unsignedBigInteger('acf_template_id');
            $table->unsignedTinyInteger('sort_position')->default(0);
            $table->timestamps();

            $table->foreign('acf_template_id')
                ->references('id')
                ->on('acf_templates')
                ->cascadeOnDelete();

            $table->foreign('acf_build_id')
                ->references('id')
                ->on('acf_builds')
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acf_connects');
    }
};

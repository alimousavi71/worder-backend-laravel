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
        Schema::create('acf_stores', function (Blueprint $table) {
            $table->id();
            $table->morphs('target');
            $table->unsignedBigInteger('acf_template_id');
            $table->unsignedBigInteger('acf_field_id');

            $table->text('value')->nullable();

            $table->unsignedTinyInteger('sort_position')->default(0);

            $table->foreign('acf_template_id')
                ->references('id')
                ->on('acf_templates')
                ->cascadeOnDelete();

            $table->foreign('acf_field_id')
                ->references('id')
                ->on('acf_fields')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acf_stores');
    }
};

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
        Schema::create('acf_fields', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('required')->default(false);
            $table->enum('type', ['Text', 'Url', 'Textarea', 'Range', 'Date', 'Image', 'Email', 'Number', 'File', 'Select', 'Repeater'])->default('Text');
            $table->unsignedBigInteger('parent')->nullable();
            $table->unsignedBigInteger('acf_template_id');
            $table->text('props')->nullable();
            $table->unsignedTinyInteger('sort_position')->default(0);

            $table->foreign('acf_template_id')
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
        Schema::dropIfExists('acf_fields');
    }
};

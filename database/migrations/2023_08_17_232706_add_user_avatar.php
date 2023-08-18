<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropColumns('users', 'avatar');
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('avatar_id')->nullable();
            $table->foreign('avatar_id')->references('id')->on('avatars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['avatar_id']);
            $table->dropColumn('avatar_id');
            $table->string('avatar')->nullable();
        });
    }
};

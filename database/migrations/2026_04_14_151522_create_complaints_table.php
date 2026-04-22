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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained('users')->onDelete('cascade');
            $table->string('photo_path');
            $table->text('description')->nullable();
            $table->string('area');
            $table->string('status')->default('pending'); // pending, in_progress, resolved
            $table->string('wing')->nullable();
            $table->string('floor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};

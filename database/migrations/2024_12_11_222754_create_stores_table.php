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
        Schema::create('stores', function (Blueprint $table) {
            // id BIGINT UNSIGNED AUTO INCREMENT PRIMARY
            $table->id();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('stores')
                ->nullOnDelete();
            $table->string('name'); // VARCHAR(255)
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('status', ['active', 'archived'])->default('active');
            // 2 columns: created_at and updated_at (timestamp)
            $table->timestamps(); });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};

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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->enum('status', ['show', 'hide'])->default('show');
            $table->string('cover_image', 500)->nullable();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->auditions();
            $table->timestamps();

            $table->index('title');
            $table->index('status');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};

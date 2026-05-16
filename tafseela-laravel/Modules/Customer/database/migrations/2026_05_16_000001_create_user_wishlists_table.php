<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_wishlists', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->unique('user_id');
            $table->json('products');
            $table->auditions();
            $table->timestamps();

            $table->index(['user_id', 'created_at', 'updated_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_wishlists');
    }
};

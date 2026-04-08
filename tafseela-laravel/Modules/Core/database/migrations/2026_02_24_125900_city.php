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
        Schema::create('cities', function (Blueprint $table): void {
            $table->id();
            $table->json('city');
            $table->foreignId('country_id')
                ->constrained('countries')
                ->cascadeOnDelete();
            $table->boolean('user_location')->default(false);
            $table->boolean('serving_location')->default(false);
            $table->timestamps();

            $table->index(['country_id', 'user_location', 'serving_location']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};

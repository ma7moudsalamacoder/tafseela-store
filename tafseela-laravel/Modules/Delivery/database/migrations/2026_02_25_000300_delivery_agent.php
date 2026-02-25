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
        Schema::create('delivery_agents', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->enum('type', ['freelance', 'company'])->default('freelance');
            $table->foreignId('delivery_company_id')
                ->nullable()
                ->constrained('delivery_companies')
                ->nullOnDelete();
            $table->auditions();
            $table->timestamps();

            $table->index(['user_id', 'type', 'delivery_company_id']);
            $table->index('delivery_company_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_agents');
    }
};

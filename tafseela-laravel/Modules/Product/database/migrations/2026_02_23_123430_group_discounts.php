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
        Schema::create('group_discounts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('item_id')->constrained('products')->cascadeOnDelete();
            $table->enum('managed_by', ['auto', 'user'])->default('user');
            $table->enum('type', ['rate', 'amount']);
            $table->decimal('value', 10, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();

            $table->index(['item_id', 'start_date', 'end_date']);
            $table->index(['managed_by', 'type']);
        });

        Schema::create('group_discounts_details', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('item_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('group_discount_id')->constrained('group_discounts')->cascadeOnDelete();
            $table->timestamps();

            $table->index(['item_id', 'group_discount_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_discounts_details');
        Schema::dropIfExists('group_discounts');
    }
};

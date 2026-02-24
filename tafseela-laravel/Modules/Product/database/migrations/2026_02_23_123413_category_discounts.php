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
        Schema::create('category_discounts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('item_id')->constrained('categories')->cascadeOnDelete();
            $table->enum('managed_by', ['auto', 'user'])->default('user');
            $table->enum('type', ['rate', 'amount']);
            $table->decimal('value', 10, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_discounts');
    }
};

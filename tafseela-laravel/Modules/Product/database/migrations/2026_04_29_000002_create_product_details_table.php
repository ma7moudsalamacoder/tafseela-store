<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_details', function (Blueprint $table): void {
            $table->id();
            $table->string('size', 20)->nullable();
            $table->string('color', 20)->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('stock_qty')->default(0);
            $table->enum('status', ['show', 'hide'])->default('show');
            $table->string('notes', 200)->nullable();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->auditions();
            $table->timestamps();

            $table->index('product_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};

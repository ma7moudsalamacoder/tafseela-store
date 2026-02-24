<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('product',255);
            $table->integer('qty');
            $table->decimal('price',10,2)->default(0);
            $table->decimal('discount',10,2)->default(0);
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->index(['order_id', 'product']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('order_details');
    }
};

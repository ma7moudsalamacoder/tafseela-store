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
        Schema::create('order_deliveries', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->foreignId('customer_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('user_location_id')
                ->constrained('user_locations')
                ->cascadeOnDelete();
            $table->foreignId('delivery_man_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->enum('status', ['pending', 'delivered', 'declined_by_customer', 'declined_by_delivery_man'])
                ->default('pending');
            $table->text('reason')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->auditions();
            $table->timestamps();

            $table->index(['order_id', 'customer_id', 'delivery_man_id', 'status', 'confirmed']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_deliveries');
    }
};

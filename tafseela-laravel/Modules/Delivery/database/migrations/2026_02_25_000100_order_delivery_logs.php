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
        Schema::create('order_delivery_logs', function (Blueprint $table): void {
            $table->id();
            $table->foreignUuid('order_delivery_id')
                ->constrained('order_deliveries')
                ->cascadeOnDelete();
            $table->enum('status', [
                'order_received',
                'preparing_order_package',
                'ready_to_deliver',
                'picked_by_delivery_man',
                'delivered_to_customer',
                'declined_by_customer',
                'declined_by_delivery_man',
            ]);
            $table->timestamp('timestamp')->useCurrent();

            $table->index(['order_delivery_id', 'status', 'timestamp']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_delivery_logs');
    }
};


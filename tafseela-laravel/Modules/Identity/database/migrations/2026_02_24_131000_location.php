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
        Schema::create('user_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->enum('type', ['home', 'work', 'other'])->default('home');
            $table->string('label')->nullable();
            $table->string('recipient_name');
            $table->string('recipient_phone', 30);
            $table->foreignId('country_id')
                ->constrained('countries')
                ->cascadeOnDelete();
            $table->foreignId('city_id')
                ->constrained('cities')
                ->cascadeOnDelete();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('street')->nullable();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('building_no')->nullable();
            $table->string('floor_no')->nullable();
            $table->string('apartment_no')->nullable();
            $table->string('postal_code', 30)->nullable();
            $table->string('landmark')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('delivery_notes')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'is_default']);
            $table->index(['user_id', 'type']);
            $table->index(['country_id', 'city_id']);
            $table->index('postal_code');
            $table->index('recipient_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_locations');
    }
};

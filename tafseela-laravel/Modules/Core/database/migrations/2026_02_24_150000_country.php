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
        Schema::create('countries', function (Blueprint $table): void {
            $table->id();
            $table->json('country');
            $table->string('country_code', 2);
            $table->string('phone_code', 5);
            $table->string('currency');
            $table->string('flag', 20)->nullable();
            $table->string('gmt_timezone', 10)->nullable();
            $table->boolean('user_location')->default(false);
            $table->boolean('serving_location')->default(false);
            $table->timestamps();

            $table->index(['country_code', 'user_location', 'serving_location']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};

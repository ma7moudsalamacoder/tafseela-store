<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            if (Schema::hasColumn('products', 'price')) {
                $table->dropIndex(['price']);
                $table->dropColumn('price');
            }

            if (Schema::hasColumn('products', 'stock_qty')) {
                $table->dropColumn('stock_qty');
            }

            $table->string('fabric', 100)->nullable()->after('tags');
            $table->string('notes', 200)->nullable()->after('fabric');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->decimal('price', 10, 2)->after('tags');
            $table->unsignedInteger('stock_qty')->default(0)->after('price');
            $table->dropColumn(['fabric', 'notes']);
            $table->index('price');
        });
    }
};

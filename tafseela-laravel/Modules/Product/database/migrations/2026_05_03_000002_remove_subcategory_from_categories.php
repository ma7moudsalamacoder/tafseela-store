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
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'subcategory')) {
                // Drop index first if it exists
                $table->dropIndex(['category', 'subcategory']);
                $table->dropColumn('subcategory');

                // Add index for category since the composite index is gone
                $table->index('category');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('subcategory')->nullable()->after('category');
            $table->dropIndex(['category']);
            $table->index(['category', 'subcategory']);
        });
    }
};

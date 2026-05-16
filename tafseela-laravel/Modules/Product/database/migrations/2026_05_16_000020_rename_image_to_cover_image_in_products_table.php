<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('cover_image', 1000)->nullable()->after('status');
        });

        DB::table('products')->whereNotNull('image')->update([
            'cover_image' => DB::raw('image'),
        ]);

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image', 255)->nullable()->after('status');
        });

        DB::table('products')->whereNotNull('cover_image')->update([
            'image' => DB::raw('cover_image'),
        ]);

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('cover_image');
        });
    }
};

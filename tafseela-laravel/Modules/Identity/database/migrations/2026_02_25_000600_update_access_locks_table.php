<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('access_locks', function (Blueprint $table): void {
            $table->dropColumn(['reason']);
            $table->string('hash')->after('user_id');
            $table->string('ip_address', 45)->nullable()->after('hash');
            $table->string('device')->nullable()->after('ip_address');
        });
    }

    public function down(): void
    {
        Schema::table('access_locks', function (Blueprint $table): void {
            $table->dropColumn(['hash', 'ip_address', 'device']);
            $table->char('reason', 50)->after('user_id');
        });
    }
};

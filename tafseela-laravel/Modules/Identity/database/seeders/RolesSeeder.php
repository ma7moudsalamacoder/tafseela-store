<?php

namespace Modules\Identity\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'product_manager', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'sales_manager', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'delivery_man', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'api']);
        Role::firstOrCreate(['name' => 'product_manager', 'guard_name' => 'api']);
        Role::firstOrCreate(['name' => 'sales_manager', 'guard_name' => 'api']);
        Role::firstOrCreate(['name' => 'delivery_man', 'guard_name' => 'api']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
    }
}


<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modules\Admin\Database\Seeders\AdminDatabaseSeeder;
use Modules\Cart\Database\Seeders\CartDatabaseSeeder;
use Modules\Core\Database\Seeders\CoreDatabaseSeeder;
use Modules\Identity\Database\Seeders\IdentityDatabaseSeeder;
use Modules\Order\Database\Seeders\OrderDatabaseSeeder;
use Modules\Payment\Database\Seeders\PaymentDatabaseSeeder;
use Modules\Product\Database\Seeders\ProductDatabaseSeeder;
use Modules\Support\Database\Seeders\SupportDatabaseSeeder;

class InstallSystem extends Command
{
    protected $signature = 'core:install {--fresh : Drop all tables before migrating}';

    protected $description = 'Install core system features: run ordered migrations and seeders';

    public function handle(): int
    {
        $this->info('Starting core system installation...');

        if ($this->option('fresh')) {
            $this->warn('Running migrate:fresh');
            Artisan::call('migrate:fresh', ['--force' => true]);
        }

        $this->runMigrations();
        $this->runSeeders();

        $this->info('Core system installation completed successfully');

        return self::SUCCESS;
    }

    private function runMigrations(): void
    {
        $this->info('Running migrations in order...');

        $migrationPaths = [
            base_path('Modules/Core/database/migrations'),
            base_path('Modules/Identity/database/migrations'),
            base_path('Modules/Product/database/migrations'),
            base_path('Modules/Cart/database/migrations'),
            base_path('Modules/Order/database/migrations'),
            base_path('Modules/Payment/database/migrations'),
            base_path('Modules/Support/database/migrations'),
            base_path('Modules/Admin/database/migrations'),
        ];

        foreach ($migrationPaths as $path) {
            $this->line("Migrating: {$path}");

            Artisan::call('migrate', [
                '--path' => $path,
                '--force' => true,
            ]);

            $this->output->write(Artisan::output());
        }
    }

    private function runSeeders(): void
    {
        $this->info('Running seeders in order...');

        $seeders = [
            CoreDatabaseSeeder::class,
            IdentityDatabaseSeeder::class,
            ProductDatabaseSeeder::class,
            CartDatabaseSeeder::class,
            OrderDatabaseSeeder::class,
            PaymentDatabaseSeeder::class,
            SupportDatabaseSeeder::class,
            AdminDatabaseSeeder::class,
        ];

        foreach ($seeders as $seeder) {
            $this->line("Seeding: {$seeder}");

            Artisan::call('db:seed', [
                '--class' => $seeder,
                '--force' => true,
            ]);

            $this->output->write(Artisan::output());
        }
    }
}

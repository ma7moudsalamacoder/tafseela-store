Set-Location -Path '\\192.168.0.101\shared\workspace\Sites\tafseela\tafseela-laravel'
php artisan db:seed --class=Modules\\Product\\Database\\Seeders\\ProductDatabaseSeeder -vvv
Write-Output "SEED_COMPLETE:$LASTEXITCODE"

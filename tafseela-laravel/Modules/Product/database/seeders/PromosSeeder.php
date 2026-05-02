<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Promo;

class PromosSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            ['promo_code' => 'WELCOME10', 'used' => 5, 'total' => 100, 'status' => 'active'],
            ['promo_code' => 'SUMMER25', 'used' => 0, 'total' => 50, 'status' => 'inactive'],
        ];

        foreach ($promos as $promo) {
            Promo::create($promo);
        }
    }
}

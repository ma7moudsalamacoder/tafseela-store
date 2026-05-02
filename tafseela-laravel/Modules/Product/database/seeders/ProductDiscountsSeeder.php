<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductDiscount;

class ProductDiscountsSeeder extends Seeder
{
    public function run(): void
    {
        $first = Product::firstWhere('name', 'قميص كتان فاخر');
        $second = Product::firstWhere('name', 'فستان سهرة حرير');

        $discounts = [
            ['item_id' => $first?->id, 'managed_by' => 'user', 'type' => 'rate', 'value' => 15, 'start_date' => now()->subDays(5)->toDateString(), 'end_date' => now()->addDays(25)->toDateString()],
            ['item_id' => $second?->id, 'managed_by' => 'user', 'type' => 'amount', 'value' => 200, 'start_date' => now()->subDays(10)->toDateString(), 'end_date' => now()->addDays(20)->toDateString()],
        ];

        foreach ($discounts as $discount) {
            if (! $discount['item_id']) {
                continue;
            }

            ProductDiscount::create($discount);
        }
    }
}

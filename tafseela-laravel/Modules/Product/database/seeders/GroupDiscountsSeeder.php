<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\GroupDiscount;
use Modules\Product\Models\GroupDiscountDetail;
use Modules\Product\Models\Product;

class GroupDiscountsSeeder extends Seeder
{
    public function run(): void
    {
        $primary = Product::firstWhere('name', 'بنطال تشينو كلاسيك');
        $related = Product::firstWhere('name', 'جاكيت عصري');

        if (! $primary || ! $related) {
            return;
        }

        $groupDiscount = GroupDiscount::create([
            'item_id' => $primary->id,
            'managed_by' => 'user',
            'type' => 'rate',
            'value' => 12,
            'start_date' => now()->subDays(4)->toDateString(),
            'end_date' => now()->addDays(26)->toDateString(),
        ]);

        GroupDiscountDetail::create([
            'item_id' => $related->id,
            'group_discount_id' => $groupDiscount->id,
        ]);

        GroupDiscountDetail::create([
            'item_id' => $primary->id,
            'group_discount_id' => $groupDiscount->id,
        ]);
    }
}

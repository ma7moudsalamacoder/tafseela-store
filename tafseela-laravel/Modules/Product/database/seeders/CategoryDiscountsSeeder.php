<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Category;
use Modules\Product\Models\CategoryDiscount;

class CategoryDiscountsSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstWhere(['category' => 'رجالي', 'subcategory' => 'قمصان']);

        if (! $category) {
            return;
        }

        CategoryDiscount::create([
            'item_id' => $category->id,
            'managed_by' => 'user',
            'type' => 'rate',
            'value' => 10,
            'start_date' => now()->subDays(7)->toDateString(),
            'end_date' => now()->addDays(23)->toDateString(),
        ]);
    }
}

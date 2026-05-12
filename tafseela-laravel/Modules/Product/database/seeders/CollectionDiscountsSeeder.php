<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Collection;
use Modules\Product\Models\CollectionDiscount;

class CollectionDiscountsSeeder extends Seeder
{
    public function run(): void
    {
        $collection = Collection::firstWhere('title', 'وصلنا حديثاً');

        if (! $collection) {
            return;
        }

        CollectionDiscount::create([
            'item_id' => $collection->id,
            'managed_by' => 'user',
            'type' => 'amount',
            'value' => 150,
            'start_date' => now()->subDays(3)->toDateString(),
            'end_date' => now()->addDays(27)->toDateString(),
        ]);
    }
}

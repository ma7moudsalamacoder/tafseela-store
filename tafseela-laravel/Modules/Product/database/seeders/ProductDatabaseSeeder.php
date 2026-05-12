<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CategoriesSeeder::class,
            SubcategoriesSeeder::class,
            CollectionsSeeder::class,
            ProductsSeeder::class,
            ChildrenProductsSeeder::class,
            ProductDetailsSeeder::class,
            PromosSeeder::class,
            ProductDiscountsSeeder::class,
            CategoryDiscountsSeeder::class,
            CollectionDiscountsSeeder::class,
            GroupDiscountsSeeder::class,
        ]);
    }
}

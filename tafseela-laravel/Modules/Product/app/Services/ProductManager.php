<?php

namespace Modules\Product\Services;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Modules\Product\Enums\ItemStatus;
use Modules\Product\Models\Category;
use Modules\Product\Models\Collection as ProductCollection;
use Modules\Product\Models\Product;
use Modules\Product\Models\Subcategory;

class ProductManager
{
    /**
     * Get all unique categories.
     *
     * @param  ItemStatus  $status  default value is NONE (all)
     */
    public function getAllCategories(ItemStatus $status = ItemStatus::NONE): Collection
    {
        $query = Category::query();

        if ($status !== ItemStatus::NONE) {
            $query->where('status', $status->value);
        }

        return $query->pluck('category');
    }

    public function getAllCategoriesWithDetails(int $numOfItems = 0, ItemStatus $status = ItemStatus::NONE): Collection
    {
        $query = Category::query();

        if ($status !== ItemStatus::NONE) {
            $query->where('status', $status->value);
        }
        if ($numOfItems > 0) {
            $query->withCount('products')->take($numOfItems);
        }

        return $query->withCount('products')->get();
    }

    /**
     * Get all unique subcategories.
     *
     * @param  bool  $grouping  group subcategories by related category
     * @param  ItemStatus  $status  subcategory status
     */
    public function getAllSubCategories(bool $grouping = false, ItemStatus $status = ItemStatus::NONE): Collection
    {
        $query = Subcategory::query()->with('category');

        if ($status !== ItemStatus::NONE) {
            $query->where('status', $status->value);
        }

        if ($grouping) {
            return $query->get()
                ->groupBy(fn ($sub) => $sub->category->category)
                ->map(fn ($group) => $group->pluck('title')->unique()->values());
        }

        return $query->pluck('title')->unique();
    }

    /**
     * Get all collections.
     */
    public function getAllCollections(ItemStatus $status = ItemStatus::NONE): EloquentCollection
    {
        $query = ProductCollection::query();

        if ($status !== ItemStatus::NONE) {
            $query->where('status', $status->value);
        }

        return $query->get();
    }

    /**
     * Get collection by Name.
     */
    public function getCollectionByName(string $name, ItemStatus $status = ItemStatus::NONE): ?ProductCollection
    {
        $query = ProductCollection::query();

        if ($status !== ItemStatus::NONE) {
            $query->where('status', $status->value);
        }

        return $query->where('title', $name)->first();
    }

    /**
     * Get all products and related details (including colors).
     */
    public function getAllProducts(ItemStatus $status = ItemStatus::NONE): EloquentCollection
    {
        $query = Product::with(['details', 'category', 'subcategory']);

        if ($status !== ItemStatus::NONE) {
            $query->where('status', $status->value);
        }

        return $query->get();
    }

    /**
     * Get products by collection ID with optional filters.
     */
    public function getProductsByCollectionID(int $collectionId, array $filters = []): EloquentCollection
    {
        $query = Product::with(['details', 'category', 'subcategory'])->where('collection_id', $collectionId);

        $this->applyFilters($query, $filters);

        return $query->get();
    }

    /**
     * Get products by category ID grouped by subcategory.
     */
    public function getProductsByCategoryID(int $categoryId, array $filters = []): Collection
    {
        $query = Product::with(['details', 'category', 'subcategory'])->where('category_id', $categoryId);

        $this->applyFilters($query, $filters);

        return $query->get()->groupBy(fn ($product) => $product->subcategory->title ?? 'general');
    }

    /**
     * Get products by collection name.
     */
    public function getProductsByCollectionName(string $name, array $filters = []): EloquentCollection
    {
        $query = Product::with(['details', 'category', 'subcategory'])
            ->whereHas('collection', fn ($q) => $q->where('title', $name));

        $this->applyFilters($query, $filters);

        return $query->get();
    }

    /**
     * Get products by category name grouped by subcategory.
     */
    public function getProductsByCategoryName(string $name, array $filters = []): Collection
    {
        $query = Product::with(['details', 'category', 'subcategory'])
            ->whereHas('category', fn ($q) => $q->where('category', $name));

        $this->applyFilters($query, $filters);

        return $query->get()->groupBy(fn ($product) => $product->subcategory->title ?? 'general');
    }

    /**
     * Get product and details by ID.
     */
    public function getProductByID(int $productId): ?Product
    {
        return Product::with(['details', 'category', 'subcategory'])->find($productId);
    }

    /**
     * Apply optional filters to product query.
     */
    protected function applyFilters($query, array $filters): void
    {
        foreach ($filters as $column => $value) {
            if (in_array($column, ['name', 'price', 'status', 'fabric', 'tags'])) {
                if ($column === 'tags' && is_array($value)) {
                    foreach ($value as $tag) {
                        $query->whereJsonContains('tags', $tag);
                    }
                } else {
                    $query->where($column, $value);
                }
            }

            // Filter by details
            if ($column === 'size') {
                $query->whereHas('details', fn ($q) => $q->where('size', $value));
            }

            if ($column === 'color') {
                if (is_array($value)) {
                    $query->whereHas('details', fn ($q) => $q->whereIn('color', $value));
                } else {
                    $query->whereHas('details', fn ($q) => $q->where('color', $value));
                }
            }
            if ($column === 'stock_qty') {
                $query->whereHas('details', fn ($q) => $q->where('stock_qty', $value));
            }
        }
    }
}

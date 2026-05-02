<?php

namespace Modules\Product\Services;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Modules\Product\Enums\ItemStatus;
use Modules\Product\Models\Category;
use Modules\Product\Models\Collection as ProductCollection;
use Modules\Product\Models\Product;

class ProductManager
{
    /**
     * Load all unique categories.
     *
     * @param ItemStatus $status default value is NONE (all)
     */
    public function LoadAllCategories(ItemStatus $status = ItemStatus::NONE): Collection
    {
        $query = Category::query();

        if ($status !== ItemStatus::NONE) {
            $query->where('status', $status->value);
        }

        return $query->select('category')->distinct()->pluck('category');
    }

    /**
     * Load all unique subcategories.
     *
     * @param bool $grouping group subcategories by related category
     * @param ItemStatus $status subcategory status
     */
    public function LoadAllSubCategories(bool $grouping = false, ItemStatus $status = ItemStatus::NONE): Collection
    {
        $query = Category::query();

        if ($status !== ItemStatus::NONE) {
            $query->where('status', $status->value);
        }

        if ($grouping) {
            return $query->select('category', 'subcategory')
                ->whereNotNull('subcategory')
                ->get()
                ->groupBy('category')
                ->map(fn ($group) => $group->pluck('subcategory')->unique()->values());
        }

        return $query->select('subcategory')
            ->whereNotNull('subcategory')
            ->distinct()
            ->pluck('subcategory');
    }

    /**
     * Load all collections.
     */
    public function LoadAllCollections(ItemStatus $status = ItemStatus::NONE): EloquentCollection
    {
        $query = ProductCollection::query();

        if ($status !== ItemStatus::NONE) {
            $query->where('status', $status->value);
        }

        return $query->get();
    }

    /**
     * Load all products and related details (including colors).
     */
    public function LoadAllProducts(ItemStatus $status = ItemStatus::NONE): EloquentCollection
    {
        $query = Product::with(['details']);

        if ($status !== ItemStatus::NONE) {
            $query->where('status', $status->value);
        }

        return $query->get();
    }

    /**
     * Load products by collection ID with optional filters.
     */
    public function LoadProductsByCollectionID(int $collectionId, array $filters = []): EloquentCollection
    {
        $query = Product::with(['details'])->where('collection_id', $collectionId);

        $this->applyFilters($query, $filters);

        return $query->get();
    }

    /**
     * Load products by category ID grouped by subcategory.
     */
    public function LoadProductsByCategoryID(int $categoryId, array $filters = []): Collection
    {
        $query = Product::with(['details', 'category'])->where('category_id', $categoryId);

        $this->applyFilters($query, $filters);

        return $query->get()->groupBy(fn ($product) => $product->category->subcategory ?? 'general');
    }

    /**
     * Load products by collection name.
     */
    public function LoadProductsByCollectionName(string $name, array $filters = []): EloquentCollection
    {
        $query = Product::with(['details'])
            ->whereHas('collection', fn ($q) => $q->where('title', $name));

        $this->applyFilters($query, $filters);

        return $query->get();
    }

    /**
     * Load products by category name grouped by subcategory.
     */
    public function LoadProductsByCategoryName(string $name, array $filters = []): Collection
    {
        $query = Product::with(['details', 'category'])
            ->whereHas('category', fn ($q) => $q->where('category', $name));

        $this->applyFilters($query, $filters);

        return $query->get()->groupBy(fn ($product) => $product->category->subcategory ?? 'general');
    }

    /**
     * Load product and details by ID.
     */
    public function LoadProductByID(int $productId): ?Product
    {
        return Product::with(['details'])->find($productId);
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
        }
    }
}

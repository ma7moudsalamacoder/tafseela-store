<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\View\View;
use Modules\Cart\Services\CartService;
use Modules\Customer\Services\WishlistService;
use Modules\Product\Enums\ProductSlugs;
use Modules\Product\Models\Category;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductDiscount;
use Modules\Product\Models\Subcategory;
use Modules\Product\Services\ProductManager;

class StorefrontController extends Controller
{
    public function __construct(
        protected ProductManager $productManager,
        protected CartService $cartService,
        protected WishlistService $wishlistService
    ) {}

    private function getCartCount(): int
    {
        if (! auth()->check()) {
            return 0;
        }
        $cart = $this->cartService->getCart(auth()->id());
        $content = $cart->content ?? [];

        return array_sum(array_column($content, 'quantity'));
    }

    private function getWishlistProductIds(): array
    {
        if (! auth()->check()) {
            return [];
        }

        return $this->wishlistService->getProductIds(auth()->id());
    }

    public function index(string $slug): View
    {
        $sort = request()->query('sort_by', 'created_at');
        if ($sort === 'low_price') {
            $sort_by = 'price';
            $sort_order = 'asc';
        } elseif ($sort === 'high_price') {
            $sort_by = 'price';
            $sort_order = 'desc';
        } else {
            $sort_by = 'created_at';
            $sort_order = 'desc';
        }

        $subcategoryId = request()->query('subcategoryId');
        $min_price = request()->query('min_price');
        $max_price = request()->query('max_price');
        $size = request()->query('size');
        $color = request()->query('color');

        $slugValue = ProductSlugs::getBySlug($slug)?->value;
        $category = Category::where('category', $slugValue)->firstOrFail();

        $subcategories = $category->subcategories()->withCount('products')->get()->filter(fn ($sub) => $sub->products_count > 0);

        $productsPaginator = null;
        $selectedSubcategory = null;

        if ($subcategories->isNotEmpty()) {
            $selectedSubcategory = $subcategories->first();
            if (! empty($subcategoryId)) {
                $selectedSubcategory = $subcategories->where('id', $subcategoryId)->first() ?? $selectedSubcategory;
            }

            if ($selectedSubcategory->products_count > 0) {

                $productsQuery = $selectedSubcategory->products()->with('details');

                if ($min_price) {
                    $productsQuery->where('price', '>=', $min_price);
                }
                if ($max_price) {
                    $productsQuery->where('price', '<=', $max_price);
                }
                if ($size || $color) {
                    $productsQuery->whereHas('details', function ($query) use ($size, $color) {
                        if ($size) {
                            $query->where('size', $size);
                        }
                        if ($color) {
                            $query->where('color', $color);
                        }
                    });
                }

                $productsPaginator = $productsQuery->orderBy($sort_by, $sort_order)->simplePaginate(10);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }

        $wishlistProductIds = $this->getWishlistProductIds();

        $formattedProducts = $productsPaginator->getCollection()->map(function ($product) use ($wishlistProductIds) {
            $discount = $product->active_discount;
            $firstDetail = $product->details->first();

            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->fabric ?? 'وصف المنتج',
                'image' => $product->image ?? 'https://via.placeholder.com/400x500',
                'price' => $product->discounted_price.' ج.م',
                'old_price' => $discount ? $product->price.' ج.م' : null,
                'badge' => $discount ? ($discount->type === 'rate' ? $discount->value.'%' : 'خصم') : null,
                'default_product_detail_id' => $firstDetail?->id,
                'default_size' => $firstDetail?->size,
                'is_in_wishlist' => in_array($product->id, $wishlistProductIds),
            ];
        });

        $cartCount = $this->getCartCount();
        $wishlistCount = auth()->check() ? count($wishlistProductIds) : 0;

        return view('customer::category', compact('slug', 'category', 'subcategories', 'formattedProducts', 'selectedSubcategory', 'productsPaginator', 'sort', 'min_price', 'max_price', 'size', 'color', 'cartCount', 'wishlistCount'));
    }

    public function getSale(): View
    {
        if (! ProductDiscount::hasActiveDiscounts()) {
            abort(404);
        }

        $sort = request()->query('sort_by', 'created_at');
        if ($sort === 'low_price') {
            $sort_by = 'price';
            $sort_order = 'asc';
        } elseif ($sort === 'high_price') {
            $sort_by = 'price';
            $sort_order = 'desc';
        } else {
            $sort_by = 'created_at';
            $sort_order = 'desc';
        }

        $categoryId = request()->query('categoryId');
        $subcategoryId = request()->query('subcategoryId');
        $min_price = request()->query('min_price');
        $max_price = request()->query('max_price');
        $size = request()->query('size');
        $color = request()->query('color');

        $discountedProductIds = ProductDiscount::active()->pluck('item_id')->unique();

        $productsQuery = Product::with('details')->whereIn('id', $discountedProductIds)
            ->whereHas('details', function ($q) {
                $q->where('stock_qty', '>', 0);
            });

        // Active Categories for Sale
        $activeCategories = Category::where('status', 'show')
            ->whereHas('products', function ($q) use ($discountedProductIds) {
                $q->whereIn('id', $discountedProductIds);
            })->withCount(['products' => function ($q) use ($discountedProductIds) {
                $q->whereIn('id', $discountedProductIds);
            }])->get();

        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }

        // Subcategories
        $subcategoriesQuery = Subcategory::whereHas('products', function ($q) use ($discountedProductIds) {
            $q->whereIn('id', $discountedProductIds);
        });

        if ($categoryId) {
            $subcategoriesQuery->where('category_id', $categoryId);
        }

        $subcategories = $subcategoriesQuery->withCount(['products' => function ($q) use ($discountedProductIds) {
            $q->whereIn('id', $discountedProductIds);
        }])->get()->filter(fn ($sub) => $sub->products_count > 0);

        if ($subcategoryId) {
            $productsQuery->where('subcategory_id', $subcategoryId);
        }

        if ($min_price) {
            $productsQuery->where('price', '>=', $min_price);
        }
        if ($max_price) {
            $productsQuery->where('price', '<=', $max_price);
        }
        if ($size || $color) {
            $productsQuery->whereHas('details', function ($query) use ($size, $color) {
                if ($size) {
                    $query->where('size', $size);
                }
                if ($color) {
                    $query->where('color', $color);
                }
            });
        }

        $totalProducts = (clone $productsQuery)->count();
        $productsPaginator = $productsQuery->orderBy($sort_by, $sort_order)->simplePaginate(10);

        $wishlistProductIds = $this->getWishlistProductIds();

        $formattedProducts = $productsPaginator->getCollection()->map(function ($product) use ($wishlistProductIds) {
            $discount = $product->active_discount;
            $firstDetail = $product->details->first();

            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->fabric ?? 'وصف المنتج',
                'image' => $product->image ?? 'https://via.placeholder.com/400x500',
                'price' => $product->discounted_price.' ج.م',
                'old_price' => $discount ? $product->price.' ج.م' : null,
                'badge' => $discount ? ($discount->type === 'rate' ? $discount->value.'%' : 'خصم') : null,
                'default_product_detail_id' => $firstDetail?->id,
                'default_size' => $firstDetail?->size,
                'is_in_wishlist' => in_array($product->id, $wishlistProductIds),
            ];
        });

        $cartCount = $this->getCartCount();
        $wishlistCount = auth()->check() ? count($wishlistProductIds) : 0;

        return view('customer::sale', compact(
            'totalProducts',
            'activeCategories',
            'subcategories',
            'formattedProducts',
            'productsPaginator',
            'sort',
            'min_price',
            'max_price',
            'size',
            'color',
            'categoryId',
            'subcategoryId',
            'cartCount',
            'wishlistCount'
        ));
    }
}

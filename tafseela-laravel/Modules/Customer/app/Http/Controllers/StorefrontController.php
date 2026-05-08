<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\View\View;
use Modules\Product\Enums\ProductSlugs;
use Modules\Product\Services\ProductManager;
use Modules\Product\Models\Category;
use Modules\Product\Models\Subcategory;

class StorefrontController extends Controller
{
    public function __construct(
        protected ProductManager $productManager
    ) {
    }

    public function index(string $slug): View
    {
        $sort = request()->query('sort_by', 'created_at');
        if($sort === 'low_price') {
            $sort_by = 'price';
            $sort_order = 'asc';
        } elseif($sort === 'high_price') {
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

        $subcategories = $category->subcategories()->withCount('products')->get()->filter(fn($sub) => $sub->products_count > 0);

        $productsPaginator = null;
        $selectedSubcategory = null;

        if ($subcategories->isNotEmpty()) {
            $selectedSubcategory =  $subcategories->first();
            if(!empty($subcategoryId)){
                $selectedSubcategory = $subcategories->where('id', $subcategoryId)->first() ?? $selectedSubcategory;
            }

            if($selectedSubcategory->products_count > 0) {

                $productsQuery = $selectedSubcategory->products();

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


        $formattedProducts = $productsPaginator->getCollection()->map(function ($product) {
            return [
                'name' => $product->name,
                'description' => $product->fabric ?? 'وصف المنتج',
                'image' => $product->image ?? 'https://via.placeholder.com/400x500',
                'price' => $product->price . ' ج.م',
                'badge' => null, // Add badge logic if available in your model
            ];
        });

        return view('customer::category', compact('slug','category', 'subcategories', 'formattedProducts', 'selectedSubcategory', 'productsPaginator', 'sort', 'min_price', 'max_price', 'size', 'color'));
    }


}

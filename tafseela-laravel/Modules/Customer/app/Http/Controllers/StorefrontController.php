<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\View\View;
use Modules\Product\Models\Category;
use Modules\Product\Models\Product;

class StorefrontController extends Controller
{
    public function index(): View
    {
        $categories = Category::with('products')->get();
        $latestProducts = Product::latest()->take(10)->get();

        return view('customer::storefront.index', compact('categories', 'latestProducts'));
    }
}

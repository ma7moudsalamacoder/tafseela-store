<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\View\View;
use Modules\Product\Enums\ProductSlugs;
use Modules\Product\Services\ProductManager;

class StorefrontController extends Controller
{
    public function __construct(
        protected ProductManager $productManager
    ) {}

    public function index(string $slug): View
    {
        $slugValue = ProductSlugs::getBySlug($slug)?->value ?? null;
        if(empty($slugValue)){
            abort(404);
        } 
        $productsGrouped = $this->productManager->getProductsByCategoryName($slugValue);
        $products = $productsGrouped->flatten();
        $category = (object) ['category' => $slug];
        return view('customer::category', compact('category', 'products'));
    }
}

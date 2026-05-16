<?php

namespace Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Customer\Services\WishlistService;
use Modules\Product\Models\Product;

class WishlistController extends Controller
{
    public function __construct(
        protected WishlistService $wishlistService
    ) {}

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $result = $this->wishlistService->toggle(
            auth()->id(),
            (int) $request->product_id
        );

        if ($request->expectsJson()) {
            return response()->json($result);
        }

        return redirect()->back();
    }

    public function items()
    {
        $productIds = $this->wishlistService->getProductIds(auth()->id());

        $products = Product::whereIn('id', $productIds)
            ->with('details')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => (float) $product->price,
                    'discounted_price' => (float) $product->discounted_price,
                    'image' => $product->cover_image,
                    'slug' => Str::slug($product->name),
                    'details' => $product->details->map(fn ($d) => [
                        'id' => $d->id,
                        'size' => $d->size,
                        'color' => $d->color,
                        'cover_image' => $d->cover_image,
                        'stock_qty' => $d->stock_qty,
                    ]),
                ];
            });

        return response()->json([
            'items' => $products,
            'count' => count($products),
        ]);
    }
}

<?php

namespace Modules\Cart\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductDetail;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $content = $this->content ?? [];

        $productIds = collect($content)->pluck('product_id')->unique()->toArray();
        $detailIds = collect($content)->pluck('product_detail_id')->filter()->unique()->toArray();

        $products = Product::whereIn('id', $productIds)->with('details')->get()->keyBy('id');
        $details = ProductDetail::whereIn('id', $detailIds)->get()->keyBy('id');

        $items = collect($content)->map(function ($item) use ($products, $details) {
            $product = $products->get($item['product_id']);
            $productDetail = isset($item['product_detail_id']) ? $details->get($item['product_detail_id']) : null;

            return [
                'product_id' => $item['product_id'],
                'product_detail_id' => $item['product_detail_id'] ?? null,
                'quantity' => $item['quantity'],
                'product_name' => $product?->name,
                'price' => $product ? (float) $product->price : 0,
                'discounted_price' => $product ? (float) $product->discounted_price : 0,
                'size' => $productDetail?->size,
                'color' => $productDetail?->color,
                'subtotal' => $product ? ($product->price * $item['quantity']) : 0,
                'image' => $product?->cover_image,
                'cover_image' => $productDetail?->cover_image,
                'slug' => $product ? Str::slug($product->name) : '',
            ];
        });

        $productDetailsLookup = [];
        foreach ($products as $product) {
            $productDetailsLookup[$product->id] = $product->details->map(fn($d) => [
                'id' => $d->id,
                'size' => $d->size,
                'color' => $d->color,
                'cover_image' => $d->cover_image,
                'stock_qty' => $d->stock_qty,
            ]);
        }

        $total = $items->sum('subtotal');
        $count = $items->sum('quantity');

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'items' => $items,
            'count' => $count,
            'total' => $total,
            'updated_at' => $this->updated_at,
            'product_details_lookup' => $productDetailsLookup,
        ];
    }
}

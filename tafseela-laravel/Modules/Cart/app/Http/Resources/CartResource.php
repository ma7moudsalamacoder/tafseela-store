<?php

namespace Modules\Cart\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductDetail;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $content = $this->content ?? [];
        
        $productIds = collect($content)->pluck('product_id')->unique()->toArray();
        $detailIds = collect($content)->pluck('product_detail_id')->filter()->unique()->toArray();

        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
        $details = ProductDetail::whereIn('id', $detailIds)->get()->keyBy('id');

        $items = collect($content)->map(function ($item) use ($products, $details) {
            $product = $products->get($item['product_id']);
            $productDetail = isset($item['product_detail_id']) ? $details->get($item['product_detail_id']) : null;

            return [
                'product_id' => $item['product_id'],
                'product_detail_id' => $item['product_detail_id'] ?? null,
                'quantity' => $item['quantity'],
                'product_name' => $product?->name,
                'price' => $product?->price,
                'size' => $productDetail?->size,
                'color' => $productDetail?->color,
                'subtotal' => $product ? ($product->price * $item['quantity']) : 0,
                'image' => $product?->image,
            ];
        });

        $total = $items->sum('subtotal');
        $count = $items->sum('quantity');

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'items' => $items,
            'count' => $count,
            'total' => $total,
            'updated_at' => $this->updated_at,
        ];
    }
}

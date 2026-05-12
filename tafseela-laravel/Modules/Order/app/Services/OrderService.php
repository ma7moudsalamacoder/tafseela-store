<?php

namespace Modules\Order\Services;

use Illuminate\Support\Facades\DB;
use Modules\Cart\Services\CartService;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderDetail;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductDetail;

class OrderService
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Place an order from the user's current cart.
     */
    public function placeOrder(int $userId, array $data = []): Order
    {
        return DB::transaction(function () use ($userId, $data) {
            $cart = $this->cartService->getCart($userId);
            $content = $cart->content ?? [];

            if (empty($content)) {
                throw new \Exception('Cannot place an order with an empty cart.');
            }

            // Calculate totals and fetch products
            $productIds = collect($content)->pluck('product_id')->unique()->toArray();
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
            
            $grandTotal = 0;
            $orderDetailsData = [];

            foreach ($content as $item) {
                $product = $products->get($item['product_id']);
                if (!$product) continue;

                $price = $product->price;
                $qty = $item['quantity'];
                $subtotal = $price * $qty;
                $grandTotal += $subtotal;

                $orderDetailsData[] = [
                    'product' => $product->name, // Following existing schema
                    'qty' => $qty,
                    'price' => $price,
                    'discount' => 0, // Placeholder
                ];
            }

            // Create Order
            $order = Order::create([
                'user_id' => $userId,
                'status' => 'pending',
                'grand_total' => $grandTotal,
                'discount' => $data['discount'] ?? 0,
                'tax' => $data['tax'] ?? 0,
                'promo_code' => $data['promo_code'] ?? null,
            ]);

            // Create Order Details
            foreach ($orderDetailsData as $detailData) {
                $order->details()->create($detailData);
            }

            // Clear Cart
            $this->cartService->clearCart($userId);

            return $order;
        });
    }

    /**
     * Get orders for a user.
     */
    public function getUserOrders(int $userId)
    {
        return Order::with('details')->where('user_id', $userId)->latest()->get();
    }

    /**
     * Get order details.
     */
    public function getOrder(int $orderId, int $userId): ?Order
    {
        return Order::with('details')->where('id', $orderId)->where('user_id', $userId)->first();
    }
}

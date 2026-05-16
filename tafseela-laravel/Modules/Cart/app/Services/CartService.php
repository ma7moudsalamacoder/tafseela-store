<?php

namespace Modules\Cart\Services;

use Modules\Cart\Models\UserCart;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductDetail;

class CartService
{
    /**
     * Get or create a cart for a user.
     */
    public function getCart(int $userId): UserCart
    {
        return UserCart::firstOrCreate(
            ['user_id' => $userId],
            ['content' => []]
        );
    }

    /**
     * Add or update an item in the cart.
     */
    public function addItem(int $userId, array $itemData): UserCart
    {
        $cart = $this->getCart($userId);
        $content = $cart->content ?? [];

        $productId = $itemData['product_id'];
        $productDetailId = $itemData['product_detail_id'] ?? null;
        $quantity = $itemData['quantity'] ?? 1;

        $found = false;
        foreach ($content as &$item) {
            if ($item['product_id'] == $productId && ($item['product_detail_id'] ?? null) == $productDetailId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $content[] = [
                'product_id' => $productId,
                'product_detail_id' => $productDetailId,
                'quantity' => $quantity,
            ];
        }

        $cart->content = $content;
        $cart->save();

        return $cart;
    }

    /**
     * Update item quantity in the cart.
     */
    public function updateItem(int $userId, int $productId, ?int $productDetailId, int $quantity): UserCart
    {
        $cart = $this->getCart($userId);
        $content = $cart->content ?? [];

        foreach ($content as &$item) {
            if ($item['product_id'] == $productId && ($item['product_detail_id'] ?? null) == $productDetailId) {
                $item['quantity'] = $quantity;
                break;
            }
        }

        $cart->content = $content;
        $cart->save();

        return $cart;
    }

    /**
     * Remove an item from the cart.
     */
    public function removeItem(int $userId, int $productId, ?int $productDetailId): UserCart
    {
        $cart = $this->getCart($userId);
        $content = $cart->content ?? [];

        $content = array_values(array_filter($content, function ($item) use ($productId, $productDetailId) {
            return !($item['product_id'] == $productId && ($item['product_detail_id'] ?? null) == $productDetailId);
        }));

        $cart->content = $content;
        $cart->save();

        return $cart;
    }

    /**
     * Change the product detail (color/size) for an item in the cart.
     */
    public function changeItemDetail(int $userId, int $productId, ?int $oldDetailId, ?int $newDetailId, int $quantity): UserCart
    {
        $cart = $this->getCart($userId);
        $content = $cart->content ?? [];

        $content = array_values(array_filter($content, function ($item) use ($productId, $oldDetailId) {
            return !($item['product_id'] == $productId && ($item['product_detail_id'] ?? null) == $oldDetailId);
        }));

        $found = false;
        foreach ($content as &$item) {
            if ($item['product_id'] == $productId && ($item['product_detail_id'] ?? null) == $newDetailId) {
                $item['quantity'] = $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $content[] = [
                'product_id' => $productId,
                'product_detail_id' => $newDetailId,
                'quantity' => $quantity,
            ];
        }

        $cart->content = $content;
        $cart->save();

        return $cart;
    }

    /**
     * Clear the cart.
     */
    public function clearCart(int $userId): bool
    {
        return UserCart::where('user_id', $userId)->update(['content' => []]) >= 0;
    }
}

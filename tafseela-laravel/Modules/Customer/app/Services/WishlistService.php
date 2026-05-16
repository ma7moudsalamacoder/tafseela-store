<?php

namespace Modules\Customer\Services;

use Modules\Customer\Models\UserWishlist;

class WishlistService
{
    public function getWishlist(int $userId): UserWishlist
    {
        return UserWishlist::firstOrCreate(
            ['user_id' => $userId],
            ['products' => []]
        );
    }

    public function toggle(int $userId, int $productId): array
    {
        $wishlist = $this->getWishlist($userId);
        $products = $wishlist->products ?? [];

        if (in_array($productId, $products)) {
            $products = array_values(array_filter($products, fn ($id) => (int) $id !== $productId));
            $added = false;
        } else {
            $products[] = $productId;
            $added = true;
        }

        $wishlist->products = $products;
        $wishlist->save();

        return [
            'is_in_wishlist' => $added,
            'count' => count($products),
        ];
    }

    public function getProductIds(int $userId): array
    {
        return $this->getWishlist($userId)->products ?? [];
    }

    public function getCount(int $userId): int
    {
        return count($this->getProductIds($userId));
    }

    public function has(int $userId, int $productId): bool
    {
        return in_array($productId, $this->getProductIds($userId));
    }
}

<?php

namespace Modules\Product\Enums;

enum ProductCategories: string
{
    case MEN = 'men';
    case WOMEN = 'women';
    case KIDS = 'kids';
    case ACCESSORIES = 'accessories';

    /**
     * Get the translated label for the enum value.
     */
    public function label(): string
    {
        return __("product::enums.product_categories.{$this->value}");
    }

    /**
     * Get translated value based on key.
     */
    public static function translate(string $key): string
    {
        return __("product::enums.product_categories.{$key}");
    }
}

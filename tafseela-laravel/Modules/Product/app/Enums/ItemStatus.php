<?php

namespace Modules\Product\Enums;

enum ItemStatus: string
{
    case NONE = 'none';
    case SHOW = 'show';
    case HIDE = 'hide';

    /**
     * Get the translated label for the enum value.
     */
    public function label(): string
    {
        return __("product::enums.item_status.{$this->value}");
    }

    /**
     * Get translated value based on key.
     */
    public static function translate(string $key): string
    {
        return __("product::enums.item_status.{$key}");
    }
}

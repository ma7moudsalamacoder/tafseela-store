<?php

namespace Modules\Product\Enums;

enum ProductSlugs: string
{


    case WOMEN = "حريمي";
    case MEN = "رجالي";
    case KIDS = "أطفال";
    case NEW_ARRIVALS = "وصلنا حديثاً";
    case SALE = "تخفيضات";

   function getBySlug(string $slug): ?self
    {
        return match ($slug) {
            'women' => self::WOMEN,
            'men' => self::MEN,
            'kids' => self::KIDS,
            'new-arrivals' => self::NEW_ARRIVALS,
            'sale' => self::SALE,
            default => null
        };
    }

}
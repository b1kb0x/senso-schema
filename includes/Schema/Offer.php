<?php

namespace Senso\Schema\Schema;

use Senso\Schema\Core\Config;
use Senso\Schema\WooCommerce\ProductData;


final class Offer
{
    public static function toArray(ProductData $product): array
    {
        return self::clean([
            '@type' => 'Offer',

            'price' => $product->price,

            'priceCurrency' => $product->currency,

            'availability' => $product->availability,

            'seller' => [
                '@id' => Config::id('organization'),
            ],

            'itemCondition' => 'https://schema.org/NewCondition',
        ]);
    }
}
<?php

namespace Senso\Schema\Schema;

use Senso\Schema\Core\Config;
use Senso\Schema\Core\Node;
use Senso\Schema\WooCommerce\ProductData;

class Offer
{
    public static function toArray(ProductData $product): array
    {
        return Node::clean([
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
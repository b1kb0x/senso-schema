<?php

namespace SensoSchema\Schema;

use SensoSchema\Core\Node;
use SensoSchema\WooCommerce\ProductData;
use SensoSchema\Core\Config;

class Offer
{
    public static function build(ProductData $product): array
    {
        return Node::clean([
            '@type' => 'Offer',

            'price' => $product->price,

            'priceCurrency' => $product->currency,

            'availability' => $product->availability,

            'url' => $product->url,

            'seller' => [
                '@id' => Config::id('organization'),
            ],

            'itemCondition' => 'https://schema.org/NewCondition',
        ]);
    }
}
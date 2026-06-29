<?php

declare(strict_types=1);

namespace Senso\Schema\Schema;

use Senso\Schema\Core\Config;
use Senso\Schema\Core\Context;
use Senso\Schema\Core\Node;
use Senso\Schema\WooCommerce\ProductBuilder;
use SensoSchema\Schema\Offer;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Product schema node.
 */
final class Product extends Node
{
    public function toArray(): array
    {
        if (!function_exists('is_product') || !is_product()) {
            return [];
        }

        $wcProduct = wc_get_product(get_the_ID());

        if (!$wcProduct) {
            return [];
        }

        $product = (new ProductBuilder())->build($wcProduct);

        $context = new Context();

        return $this->clean([

            '@type' => 'Product',

            '@id' => $context->id('product'),

            'name' => $product->name,

            'url' => $product->url,

            'image' => $product->image,

            'description' => $product->description,

            'sku' => $product->sku,

            ...self::gtinProperty($product->gtin),

            'brand' => [
                '@id' => Config::id('brand'),
            ],

            'offers' => [
                '@type' => 'Offer',

                'price' => $product->price,

                'priceCurrency' => $product->currency,

                'availability' => $product->availability,



                'seller' => [
                    '@id' => Config::id('organization'),
                ],

                'itemCondition' => 'https://schema.org/NewCondition',
            ],

        ]);
    }

    private static function gtinProperty(?string $gtin): array
    {
        if (!$gtin) {
            return [];
        }

        $digits = preg_replace('/\D/', '', $gtin);

        return match (strlen($digits)) {
            8  => ['gtin8'  => $digits],
            12 => ['gtin12' => $digits],
            13 => ['gtin13' => $digits],
            14 => ['gtin14' => $digits],
            default => [],
        };
    }
}
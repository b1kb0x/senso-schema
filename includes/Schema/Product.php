<?php

declare(strict_types=1);

namespace Senso\Schema\Schema;

use Senso\Schema\Core\Config;
use Senso\Schema\Core\Context;
use Senso\Schema\Core\Node;
use Senso\Schema\WooCommerce\ProductBuilder;

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

        if ($product->image === null) {
            return [];
        }

        $context = new Context();

        $category = null;

        $terms = get_the_terms($product->id, 'product_cat');

        if (!is_wp_error($terms) && !empty($terms)) {
            $category = reset($terms)->name;
        }

        return $this->clean([

            '@type' => 'Product',

            '@id' => $context->id('product'),

            'name' => $product->name,

            'url' => $product->url,

            'mainEntityOfPage' => [
                '@id' => $context->id('webpage'),
            ],

            'image' => $product->image,

            'description' => $product->description,

            'category' => $category,

            'sku' => $product->sku,

            'mpn' => $product->mpn,

            ...self::gtinProperty($product->gtin),

            'brand' => [
                '@id' => Config::id('brand'),
            ],

            'manufacturer' => [
                '@id' => Config::id('organization'),
            ],

            'additionalProperty' => !empty($product->additionalProperties)
                ? array_map(
                    static fn(array $property) => [
                        '@type' => 'PropertyValue',
                        'name'  => $property['name'],
                        'value' => $property['value'],
                    ],
                    $product->additionalProperties
                )
                : null,

            'aggregateRating' => $product->rating !== null
                ? [
                    '@type' => 'AggregateRating',
                    'ratingValue' => $product->rating,
                    'reviewCount' => $product->reviewCount,
                ]
                : null,

            'offers' => [
                '@type' => 'Offer',

                'url' => $product->url,

                'price' => $product->price,

                'priceCurrency' => $product->currency,

                'availability' => $product->availability,

                'seller' => [
                    '@id' => Config::id('store'),
                ],

                'itemCondition' => 'https://schema.org/NewCondition',

                'hasMerchantReturnPolicy' => [
                    '@type' => 'MerchantReturnPolicy',
                    'applicableCountry' => Config::MERCHANT_RETURN_POLICY['country'],
                    'returnPolicyCategory' => Config::MERCHANT_RETURN_POLICY['category'],
                    'merchantReturnDays' => Config::MERCHANT_RETURN_POLICY['days'],
                ],

                'shippingDetails' => [

                    '@type' => 'OfferShippingDetails',

                    'shippingDestination' => [
                        '@type' => 'DefinedRegion',
                        'addressCountry' => Config::SHIPPING['country'],
                    ],

                    'deliveryTime' => [

                        '@type' => 'ShippingDeliveryTime',

                        'handlingTime' => [
                            '@type' => 'QuantitativeValue',
                            'minValue' => Config::get('shipping.handling.min'),
                            'maxValue' => Config::get('shipping.handling.max'),
                            'unitCode' => 'DAY',
                        ],

                        'transitTime' => [
                            '@type' => 'QuantitativeValue',
                            'minValue' => Config::get('shipping.transit.min'),
                            'maxValue' => Config::get('shipping.transit.max'),
                            'unitCode' => 'DAY',
                        ],

                    ],

                ],
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
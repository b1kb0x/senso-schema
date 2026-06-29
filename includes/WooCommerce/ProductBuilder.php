<?php

declare(strict_types=1);

namespace Senso\Schema\WooCommerce;

use WC_Product;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Builds normalized product data.
 */
final class ProductBuilder
{
    public function build(WC_Product $product): ProductData
    {
        return new ProductData(

            id: $product->get_id(),

            url: get_permalink($product->get_id()),

            name: $product->get_name(),

            description: wp_strip_all_tags(
                $product->get_short_description()
            ),

            sku: (string) $product->get_sku(),

            gtin: $this->resolveGtin($product),

            price: (string) $product->get_price(),

            currency: get_woocommerce_currency(),

            availability: $product->is_in_stock()
                ? 'https://schema.org/InStock'
                : 'https://schema.org/OutOfStock',

            image: wp_get_attachment_image_url(
                $product->get_image_id(),
                'full'
            ),

            specialty: [],
        );
    }

    private function resolveGtin(\WC_Product $product): ?string
    {
        $fields = [
            '_gtin',
            '_gtin8',
            '_gtin12',
            '_gtin13',
            '_gtin14',
            '_ean',
            'ean',
            '_barcode',
            'barcode',
        ];

        foreach ($fields as $field) {

            $value = trim((string) $product->get_meta($field));

            if ($value !== '') {
                return $value;
            }
        }

        return null;
    }
}
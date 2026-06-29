<?php

declare(strict_types=1);

namespace Senso\Schema\WooCommerce;

use Senso\Schema\Core\Config;
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
        error_log(
            'Schema image: ' .
            wp_get_attachment_image_url(
                $product->get_image_id(),
                'full'
            )
        );

        return new ProductData(

            id: $product->get_id(),

            url: get_permalink($product->get_id()),

            name: $product->get_name(),

            description: wp_strip_all_tags(
                $product->get_short_description()
            ),

            sku: (string) $product->get_sku(),

            gtin: $this->resolveGtin($product),

            mpn: $this->resolveMpn($product),

            rating: $this->resolveRating($product),

            reviewCount: $this->resolveReviewCount($product),

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

            additionalProperties: $this->resolveAdditionalProperties($product),
        );
    }

    private function resolveGtin(\WC_Product $product): ?string
    {
        $fields = [
            '_gtin',
            'gtin',

            '_alg_ean',
            '_alg_gtin',

            '_wpm_gtin_code',
            '_wpm_gtin',

            '_rank_math_gtin',
        ];

        foreach ($fields as $field) {

            $value = trim((string) $product->get_meta($field));

            if ($value !== '') {
                return $value;
            }
        }

        return null;
    }

    private function resolveMpn(\WC_Product $product): ?string
    {
        $fields = [
            '_mpn',
            'mpn',
        ];

        foreach ($fields as $field) {
            $value = trim((string) $product->get_meta($field));

            if ($value !== '') {
                return $value;
            }
        }

        return null;
    }

    private function resolveRating(\WC_Product $product): ?float
    {
        $rating = (float) $product->get_average_rating();

        return $rating > 0 ? $rating : null;
    }

    private function resolveReviewCount(\WC_Product $product): int
    {
        return (int) $product->get_review_count();
    }

    private function resolveAdditionalProperties(WC_Product $product): array
    {
        $properties = [];

        foreach ($product->get_attributes() as $attribute) {

            if (!$attribute->is_taxonomy()) {
                continue;
            }

            $config = Config::PRODUCT_PROPERTIES[$attribute->get_name()] ?? null;

            if (!$config || empty($config['export'])) {
                continue;
            }

            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute->get_name(),
                [
                    'fields' => 'names',
                ]
            );

            if (empty($terms)) {
                continue;
            }

            $value = implode(', ', $terms);

            if (!empty($config['suffix'])) {
                $value .= $config['suffix'];
            }

            $properties[] = [
                'name'  => $config['name'],
                'value' => $value,
            ];
        }

        return $properties;
    }
}
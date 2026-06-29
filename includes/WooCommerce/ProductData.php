<?php

declare(strict_types=1);

namespace Senso\Schema\WooCommerce;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Normalized WooCommerce product data.
 */
final readonly class ProductData
{
    public function __construct(

        public int $id,

        public string $url,

        public string $name,

        public string $description,

        public string $sku,

        public ?string $gtin,

        public string $price,

        public string $currency,

        public string $availability,

        public ?string $image,

        /**
         * Specialty coffee properties.
         *
         * Example:
         * [
         *     'country' => 'Brazil',
         *     'region' => 'Cerrado',
         * ]
         */
        public array $specialty = [],

    ) {
    }
}
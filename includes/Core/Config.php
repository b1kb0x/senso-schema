<?php

declare(strict_types=1);

namespace Senso\Schema\Core;

if (!defined('ABSPATH')) {
    exit;
}

final class Config
{
    public static function get(string $key, mixed $default = null): mixed
    {
        $config = [

            'organization' => [

                'name' => 'SENSO COFFEE',

                'logo' => home_url('/wp-content/uploads/logo.png'),

                'sameAs' => [],

                'telephone' => '',

                'email' => '',

            ],

            'website' => [

                'url' => home_url('/'),

                'name' => get_bloginfo('name'),

            ],

        ];

        $segments = explode('.', $key);

        $value = $config;

        foreach ($segments as $segment) {

            if (!array_key_exists($segment, $value)) {
                return $default;
            }

            $value = $value[$segment];
        }

        return $value;
    }

    public static function id(string $suffix): string
    {
        return trailingslashit(home_url()) . '#' . $suffix;
    }

    /**
     * WooCommerce attributes exported as additionalProperty.
     */
    public const PRODUCT_PROPERTIES = [

        'pa_altitude' => [
            'name'   => 'Altitude',
            'suffix' => ' MASL',
            'export' => true,
        ],

        'pa_q-score' => [
            'name'   => 'Q-Score',
            'suffix' => '',
            'export' => true,
        ],

        'pa_region' => [
            'name'   => 'Region',
            'suffix' => '',
            'export' => true,
        ],

        'pa_roast' => [
            'name'   => 'Roast',
            'suffix' => '',
            'export' => true,
        ],

        'pa_variety' => [
            'name'   => 'Variety',
            'suffix' => '',
            'export' => true,
        ],

        'pa_process' => [
            'name'   => 'Process',
            'suffix' => '',
            'export' => true,
        ],

        'pa_weight' => [
            'name'   => 'Weight',
            'suffix' => ' g',
            'export' => true,
        ],

        'pa_ground' => [
            'name'   => 'Ground',
            'suffix' => '',
            'export' => false,
        ],
    ];

    public const MERCHANT_RETURN_POLICY = [

        'country' => 'UA',

        'days' => 14,

        'category' => 'https://schema.org/MerchantReturnFiniteReturnWindow',

    ];

    public const SHIPPING = [

        'country' => 'UA',

        'handling_time' => [
            'min' => 0,
            'max' => 1,
        ],

        'transit_time' => [
            'min' => 1,
            'max' => 3,
        ],

    ];
}
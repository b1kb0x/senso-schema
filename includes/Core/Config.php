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
            'name' => 'Altitude',
            'suffix' => ' MASL',
        ],

        'pa_q-score' => [
            'name' => 'Q-Score',
            'suffix' => '',
        ],

        'pa_region' => [
            'name' => 'Region',
            'suffix' => '',
        ],

        'pa_roast' => [
            'name' => 'Roast',
            'suffix' => '',
        ],

        'pa_variety' => [
            'name' => 'Variety',
            'suffix' => '',
        ],

        'pa_process' => [
            'name' => 'Process',
            'suffix' => '',
        ],

        'pa_weight' => [
            'name' => 'Weight',
            'suffix' => ' g',
        ],

        'pa_ground' => [
            'name' => 'Ground',
            'suffix' => '',
        ],

    ];
}
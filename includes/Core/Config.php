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

        'pa_altitude' => 'Altitude',

        'pa_q-score'  => 'Q-Score',

        'pa_region'   => 'Region',

        'pa_roast'    => 'Roast',

        'pa_variety'  => 'Variety',

        'pa_process'  => 'Process',

        'pa_weight'   => 'Weight',

        'pa_ground'   => 'Ground',

    ];
}
<?php

namespace Senso\Schema\Diagnostics;

defined('ABSPATH') || exit;

class WooCommerceInspector
{
    public static function inspect(): array
    {
        return [

            'base_country' => WC()->countries->get_base_country(),

            'base_state' => WC()->countries->get_base_state(),

            'currency' => get_woocommerce_currency(),

            'weight_unit' => get_option('woocommerce_weight_unit'),

            'dimension_unit' => get_option('woocommerce_dimension_unit'),

            'shipping_enabled' => wc_shipping_enabled(),

            'default_country' => get_option('woocommerce_default_country'),

            'ship_to_countries' => get_option('woocommerce_ship_to_countries'),

            'zones' => \WC_Shipping_Zones::get_zones(),

        ];
    }
}

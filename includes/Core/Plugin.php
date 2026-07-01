<?php

declare(strict_types=1);

namespace Senso\Schema\Core;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main plugin class.
 */
final class Plugin
{
    /**
     * Plugin initialization.
     */
    public function run(): void
    {
        Updater::init();
        
        add_action(
            'init',
            [$this, 'init']
        );
    }

    /**
     * Initialize plugin.
     */
    public function init(): void
    {
        add_action(
            'wp_head',
            [$this, 'renderSchema'],
            1
        );

        add_action(
            'wp',
            [$this, 'disableWooStructuredData']
        );
    }

    public function renderSchema(): void
    {
        (new SchemaManager())->output();
    }

    /**
     * Disable WooCommerce frontend Schema.org output.
     */
    public function disableWooStructuredData(): void
    {
        if (
            function_exists('WC')
            && WC()->structured_data
        ) {
            remove_action(
                'wp_footer',
                [WC()->structured_data, 'output_structured_data'],
                10
            );
        }
    }
}
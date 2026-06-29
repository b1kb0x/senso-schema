<?php
/**
 * Plugin Name: Senso Schema
 * Plugin URI: https://senso.coffee
 * Description: Lightweight Schema.org generator for Senso Coffee.
 * Version: 1.0.0
 * Author: Senso Coffee
 * Author URI: https://senso.coffee
 * License: GPL2+
 * Text Domain: senso-schema
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/*
|--------------------------------------------------------------------------
| Plugin constants
|--------------------------------------------------------------------------
*/

define('SENSO_SCHEMA_VERSION', '1.0.0');
define('SENSO_SCHEMA_PATH', plugin_dir_path(__FILE__));
define('SENSO_SCHEMA_URL', plugin_dir_url(__FILE__));

/*
|--------------------------------------------------------------------------
| Autoloader
|--------------------------------------------------------------------------
*/

require_once SENSO_SCHEMA_PATH . 'includes/Core/Loader.php';

/*
|--------------------------------------------------------------------------
| Boot plugin
|--------------------------------------------------------------------------
*/

(new Senso\Schema\Core\Plugin())->run();
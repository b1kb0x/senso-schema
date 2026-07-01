<?php

declare(strict_types=1);

namespace Senso\Schema\Core;

if (!defined('ABSPATH')) {
    exit;
}

require_once SENSO_SCHEMA_PATH . 'includes/lib/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

if (!defined('ABSPATH')) {
    exit;
}

final class Updater
{
    private static bool $initialized = false;

    public static function init(): void
    {
        if (self::$initialized) {
            return;
        }

        self::$initialized = true;
        
        PucFactory::buildUpdateChecker(
            'https://w2x.org/updates/schema.json',
            SENSO_SCHEMA_FILE,
            'senso-schema'
        );
    }
}
<?php

declare(strict_types=1);

namespace Senso\Schema\Core;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

if (!defined('ABSPATH')) {
    exit;
}

final class Updater
{
    public static function init(): void
    {
        PucFactory::buildUpdateChecker(
            'https://w2x.org/updates/schema.json',
            SENSO_SCHEMA_FILE,
            'senso-schema'
        );
    }
}
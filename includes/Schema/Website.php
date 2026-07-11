<?php

declare(strict_types=1);

namespace Senso\Schema\Schema;

use Senso\Schema\Core\Config;
use Senso\Schema\Core\Context;
use Senso\Schema\Core\Node;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * WebSite schema node.
 */
final class WebSite extends Node
{
    public function toArray(): array
    {
        $context = new Context();

        return $this->clean([
            '@type' => 'WebSite',

            '@id' => Config::id('website'),

            'url' => Config::get('website.url'),

            'name' => Config::get('website.name'),

            'publisher' => [
                '@id' => Config::id('store'),
            ],

            'inLanguage' => $context->language(),

        ]);
    }
}
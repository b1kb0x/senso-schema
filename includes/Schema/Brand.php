<?php

declare(strict_types=1);

namespace Senso\Schema\Schema;

use Senso\Schema\Core\Config;
use Senso\Schema\Core\Node;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Brand schema node.
 */
final class Brand extends Node
{
    public function toArray(): array
    {
        return $this->clean([

            '@type' => 'Brand',

            '@id' => Config::id('brand'),

            'name' => Config::get('organization.name'),

        ]);
    }
}
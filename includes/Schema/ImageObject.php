<?php

declare(strict_types=1);

namespace Senso\Schema\Schema;

use Senso\Schema\Core\Config;
use Senso\Schema\Core\Node;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Organization logo.
 */
final class ImageObject extends Node
{
    public function toArray(): array
    {
        return $this->clean([

            '@type' => 'ImageObject',

            '@id' => Config::id('logo'),

            'url' => Config::get('organization.logo'),

            'contentUrl' => Config::get('organization.logo'),

            'caption' => Config::get('organization.name'),

        ]);
    }
}
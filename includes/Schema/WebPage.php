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
 * WebPage schema node.
 */
final class WebPage extends Node
{
    public function toArray(): array
    {
        $context = new Context();

        return $this->clean([

            '@type' => 'WebPage',

            '@id' => $context->id('webpage'),

            'url' => $context->url(),

            'name' => $context->title(),

            'inLanguage' => $context->language(),

            'isPartOf' => [
                '@id' => Config::id('website'),
            ],

            'about' => [
                '@id' => Config::id('organization'),
            ],

            'breadcrumb' => [
                '@id' => $context->id('breadcrumb'),
            ],

        ]);
    }
}
<?php

declare(strict_types=1);

namespace Senso\Schema\Schema;

use Senso\Schema\Core\Context;
use Senso\Schema\Core\Builders\BreadcrumbBuilder;
use Senso\Schema\Core\Node;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * BreadcrumbList schema node.
 */
final class BreadcrumbList extends Node
{
    public function toArray(): array
    {
        $context = new Context();

        $builder = new BreadcrumbBuilder();

        $elements = [];

        foreach ($builder->build() as $position => $item) {

            $elements[] = [

                '@type'    => 'ListItem',

                'position' => $position + 1,

                'name'     => $item['name'],

                'item'     => $item['url'],

            ];
        }

        return $this->clean([

            '@type' => 'BreadcrumbList',

            '@id' => $context->id('breadcrumb'),

            'itemListElement' => $elements,

        ]);
    }
}
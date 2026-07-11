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

        $hasProduct = $context->hasProductSchema();

        $pageType = 'WebPage';

        if (
            is_shop() ||
            is_product_category() ||
            is_post_type_archive('product')
        ) {
            $pageType = 'CollectionPage';
        }

        $name = $context->title();

        if ($hasProduct) {

            $product = wc_get_product(get_the_ID());

            if ($product instanceof \WC_Product) {
                $name = $product->get_name();
            }
        }

        return $this->clean([

            '@type' => $pageType,

            '@id' => $context->id('webpage'),

            'url' => $context->url(),

            'name' => $name,

            'inLanguage' => $context->language(),

            'isPartOf' => [
                '@id' => Config::id('website'),
            ],

            $hasProduct
                ? 'mainEntity'
                : 'about' => [
                '@id' => $hasProduct
                    ? $context->id('product')
                    : Config::id('organization'),
            ],

            'breadcrumb' => [
                '@id' => $context->id('breadcrumb'),
            ],

        ]);
    }
}
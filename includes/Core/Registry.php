<?php

declare(strict_types=1);

namespace Senso\Schema\Core;

use Senso\Schema\Schema\ImageObject;
use Senso\Schema\Schema\Organization;
use Senso\Schema\Schema\WebSite;
use Senso\Schema\Schema\WebPage;
use Senso\Schema\Schema\BreadcrumbList;
use Senso\Schema\Schema\Brand;
use Senso\Schema\Schema\Product;
use Senso\Schema\Schema\OnlineStore;


if (!defined('ABSPATH')) {
    exit;
}

/**
 * Schema node registry.
 */
final class Registry
{
    /**
     * Registered schema nodes.
     *
     * @return array<class-string>
     */
    public static function nodes(): array
    {
        return [

            ImageObject::class,

            Organization::class,

            OnlineStore::class,

            WebSite::class,

            WebPage::class,

            BreadcrumbList::class,

            Brand::class,

            Product::class,

        ];
    }
}
<?php

declare(strict_types=1);

namespace Senso\Schema\Core\Builders;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Builds breadcrumb trail.
 */
final class BreadcrumbBuilder
{
    /**
     * @return array<int, array{name:string,url:string}>
     */
    public function build(): array
    {
        $items = [];

        // Главная
        $items[] = [
            'name' => get_bloginfo('name'),
            'url'  => home_url('/'),
        ];

        // Если это обычная страница (не главная)
        if (is_page() && !is_front_page()) {

            $ancestors = array_reverse(get_post_ancestors(get_the_ID()));

            foreach ($ancestors as $ancestorId) {

                $items[] = [
                    'name' => get_the_title($ancestorId),
                    'url'  => get_permalink($ancestorId),
                ];
            }

            $items[] = [
                'name' => get_the_title(),
                'url'  => get_permalink(),
            ];
        }

        return $items;
    }
}
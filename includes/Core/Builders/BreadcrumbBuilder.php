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

        if (is_singular('product')) {

            $terms = get_the_terms(get_the_ID(), 'product_cat');

            if (! empty($terms) && ! is_wp_error($terms)) {

                $category = reset($terms);

                $link = get_term_link($category);

                if (! is_wp_error($link)) {
                    $items[] = [
                        'name' => $category->name,
                        'url'  => $link,
                    ];
                }
            }

            $items[] = [
                'name' => get_the_title(),
                'url'  => get_permalink(),
            ];

            return $items;
        }

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
<?php

declare(strict_types=1);

namespace Senso\Schema\Core;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Current page context.
 */
final class Context
{
    /**
     * Current page URL.
     */
    public function url(): string
    {
        if (is_front_page()) {
            return home_url('/');
        }

        if (is_singular()) {

            $url = get_permalink();

            return is_string($url)
                ? $url
                : home_url('/');
        }

        if (is_home()) {

            $url = get_permalink(
                get_option('page_for_posts')
            );

            return is_string($url)
                ? $url
                : home_url('/');
        }

        if (is_category() || is_tag() || is_tax()) {

            $url = get_term_link(
                get_queried_object()
            );

            return is_wp_error($url)
                ? home_url('/')
                : $url;
        }

        if (is_post_type_archive()) {

            $url = get_post_type_archive_link(
                get_post_type()
            );

            return is_string($url)
                ? $url
                : home_url('/');
        }

        global $wp;

        if (isset($wp)) {
            return home_url(add_query_arg([], $wp->request));
        }

        return home_url('/');
    }

    /**
     * Current page title.
     */
    public function title(): string
    {
        return wp_get_document_title();
    }

    /**
     * Current language.
     */
    public function language(): string
    {
        return get_bloginfo('language');
    }

    /**
     * Build @id for current page entities.
     */
    public function id(string $suffix): string
    {
        return trailingslashit($this->url()) . '#' . ltrim($suffix, '#');
    }

    /**
     * Whether the current page can publish a Product schema.
     */
    public function hasProductSchema(): bool
    {
        if (!function_exists('is_product') || !is_product()) {
            return false;
        }

        return wc_get_product(get_the_ID()) !== null;
    }
}
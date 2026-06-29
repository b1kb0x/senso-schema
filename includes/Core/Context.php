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
            return get_permalink();
        }

        if (is_home()) {
            return get_permalink(get_option('page_for_posts'));
        }

        if (is_category() || is_tag() || is_tax()) {
            return get_term_link(get_queried_object());
        }

        if (is_post_type_archive()) {
            return get_post_type_archive_link(get_post_type());
        }

        return home_url(add_query_arg([], $GLOBALS['wp']->request));
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
        return untrailingslashit($this->url()) . '#' . $suffix;
    }
}
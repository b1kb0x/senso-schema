<?php

declare(strict_types=1);

namespace Senso\Schema\Core;


if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main Schema manager.
 */
final class SchemaManager
{
    /**
     * Output JSON-LD.
     */
    public function output(): void
    {
        $graph = new Graph();

        foreach (Registry::nodes() as $node) {
            $graph->add(new $node());
        }

        $data = $graph->toArray();

        $json = wp_json_encode(
            $data,
            JSON_UNESCAPED_UNICODE
            | JSON_UNESCAPED_SLASHES
            | JSON_PRETTY_PRINT
        );

        if ($json === false) {
            error_log('Schema JSON error: ' . json_last_error_msg());
            return;
        }

        echo '<script type="application/ld+json">';
        echo $json;
        echo '</script>';
    }
}
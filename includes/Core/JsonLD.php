<?php

declare(strict_types=1);

namespace Senso\Schema\Core;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * JSON-LD renderer.
 */
final class JsonLD
{
    /**
     * Print JSON-LD.
     */
    public function render(array $graph): void
    {
        echo '<script type="application/ld+json">';
        echo wp_json_encode(
            $graph,
            JSON_UNESCAPED_UNICODE
            | JSON_UNESCAPED_SLASHES
            | JSON_PRETTY_PRINT
        );
        echo '</script>';
    }
}
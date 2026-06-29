<?php

declare(strict_types=1);

namespace Senso\Schema\Contracts;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Contract for every Schema node.
 */
interface SchemaNodeInterface
{
    /**
     * Convert node to Schema array.
     */
    public function toArray(): array;
}
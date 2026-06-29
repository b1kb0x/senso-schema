<?php

declare(strict_types=1);

namespace Senso\Schema\Core;

if (! defined('ABSPATH')) {
    exit;
}

final class SchemaCleaner
{
    public static function clean(array $data): array
    {
        foreach ($data as $key => $value) {

            if (is_array($value)) {
                $value = self::clean($value);

                if ($value === []) {
                    unset($data[$key]);
                    continue;
                }

                $data[$key] = $value;
                continue;
            }

            if ($value === null || $value === '') {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
<?php

declare(strict_types=1);

namespace Senso\Schema\Core;

use Senso\Schema\Contracts\SchemaNodeInterface;

abstract class Node implements SchemaNodeInterface
{
    /**
     * Remove empty values recursively.
     */
    protected function clean(array $data): array
    {
        foreach ($data as $key => $value) {

            if (is_array($value)) {
                $value = $this->clean($value);
            }

            if (
                $value === null ||
                $value === '' ||
                $value === [] ||
                $value === false
            ) {
                unset($data[$key]);
                continue;
            }

            $data[$key] = $value;
        }

        return $data;
    }
}
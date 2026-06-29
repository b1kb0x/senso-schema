<?php

declare(strict_types=1);

namespace Senso\Schema\Core;

use Senso\Schema\Contracts\SchemaNodeInterface;

final class Graph
{
    /**
     * @var SchemaNodeInterface[]
     */
    private array $nodes = [];

    public function add(SchemaNodeInterface $node): self
    {
        $this->nodes[] = $node;

        return $this;
    }

    public function toArray(): array
    {
        $graph = [];

        foreach ($this->nodes as $node) {

            $item = $node->toArray();

            if ($item === []) {
                continue;
            }

            $graph[] = $item;
        }
        return [

            '@context' => 'https://schema.org',

            '@graph' => $graph,

        ];
    }
}
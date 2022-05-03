<?php

namespace Infra\Lib\Collection;

interface Collection
{
    public function count(): int;

    public function isEmpty(): bool;

    public static function fromArray(array $items): self;

    public function toArray(): array;

    public function toIterable(): array;

    public function map(callable $callback, array ...$arrays): array;

    public function filter(callable $callback, int $mode = 0): self;

    public function reduce(callable $callback, mixed $initial): mixed;
}

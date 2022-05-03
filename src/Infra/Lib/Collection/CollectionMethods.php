<?php

namespace Infra\Lib\Collection;

trait CollectionMethods
{
    private int $position;

    private array $array = [];

    public function __construct()
    {
        $this->position = 0;
    }

    /**
     * @codeCoverageIgnore
     */
    public function current(): mixed
    {
        return $this->array[$this->position];
    }

    /**
     * @codeCoverageIgnore
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @codeCoverageIgnore
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @codeCoverageIgnore
     */
    public function valid(): bool
    {
        return array_key_exists($this->position, $this->array);
    }

    /**
     * @codeCoverageIgnore
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @codeCoverageIgnore
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->array);
    }

    /**
     * @codeCoverageIgnore
     */
    public function offsetGet($offset): mixed
    {
        return $this->array[$offset] ?? null;
    }

    /**
     * @codeCoverageIgnore
     */
    public function offsetSet($offset, $value): void
    {
        $this->validItem($value);
        if (is_null($offset)) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function offsetUnset($offset): void
    {
        unset($this->array[$offset]);
    }

    public function count(): int
    {
        return iterator_count($this);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function toIterable(): array
    {
        return iterator_to_array($this);
    }

    public function map(callable $callback, array ...$arrays): array
    {
        return array_map($callback, $this->toIterable(), $arrays);
    }

    public function filter(callable $callback, int $mode = 0): self
    {
        $items = array_filter($this->toIterable(), $callback, $mode);
        return self::fromArray($items);
    }

    public function reduce(callable $callback, mixed $initial): mixed
    {
        return array_reduce($this->toIterable(), $callback, $initial);
    }

    public function toArray(): array
    {
        return $this->toIterable();
    }

    public static function fromArray(array $items): self
    {
        return array_reduce(
            $items,
            function (Collection $collection, mixed $item) {
                $collection[] = $item;
                return $collection;
            },
            new static()
        );
    }
}

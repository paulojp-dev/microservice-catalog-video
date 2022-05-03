<?php

namespace Infra\Lib\Collection;

abstract class ObjectCollection implements \Iterator, \ArrayAccess, \Countable, Collection
{
    use CollectionMethods;

    protected function validItem(mixed $value): void
    {
        $class = $this->objectClass();
        if (!$value instanceof $class) {
            $msg = "Collection value must be instance of '$class'.";
            throw new \InvalidArgumentException($msg);
        }
    }

    abstract protected function objectClass(): string;
}

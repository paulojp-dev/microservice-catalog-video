<?php

namespace Infra\Lib\Collection;

use Infra\Lib\Shared\PrimitiveType;

abstract class PrimitiveTypeCollection implements \Iterator, \ArrayAccess, \Countable, Collection
{
    use CollectionMethods;

    protected function validItem(mixed $value): void
    {
        if (gettype($value) !== $this->primitiveType()->value) {
            $msg = "Collection value must be type of '{$this->primitiveType()->value}'.";
            throw new \InvalidArgumentException($msg);
        }
    }

    abstract protected function primitiveType(): PrimitiveType;
}

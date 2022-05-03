<?php

namespace Infra\Adapter\Uuid;

use Ramsey\Uuid\Uuid;

class UuidAdapter
{
    public static function random(): string
    {
        return Uuid::uuid4()->toString();
    }

    public static function isValid(string $uuid): bool
    {
        return Uuid::isValid($uuid);
    }
}

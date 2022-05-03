<?php

namespace Domain\Validation\Rule;

use Ramsey\Uuid\Uuid;

class UuidRule extends BaseRule
{
    protected function isValid(mixed $value): bool
    {
        return Uuid::isValid($value);
    }

    public function message(string $field): string
    {
        return "Invalid $field.";
    }
}

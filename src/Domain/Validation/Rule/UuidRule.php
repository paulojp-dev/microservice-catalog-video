<?php

namespace Domain\Validation\Rule;

use Infra\Adapter\Uuid\UuidAdapter;

class UuidRule extends BaseRule
{
    protected function isValid(mixed $value): bool
    {
        return UuidAdapter::isValid($value);
    }

    public function message(string $field): string
    {
        return "Invalid $field.";
    }
}

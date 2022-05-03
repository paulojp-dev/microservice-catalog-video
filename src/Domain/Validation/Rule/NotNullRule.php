<?php

namespace Domain\Validation\Rule;

class NotNullRule extends BaseRule
{
    protected bool $forceValidateNullValue = true;

    protected function isValid(mixed $value): bool
    {
        return !is_null($value);
    }

    public function message(string $field): string
    {
        return "{$this->upFirstLetter($field)} cannot be null.";
    }
}

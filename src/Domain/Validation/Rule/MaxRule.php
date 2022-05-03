<?php

namespace Domain\Validation\Rule;

class MaxRule extends BaseRule
{
    public function __construct(
        private float $max,
        ?string $message = null
    ) {
        parent::__construct($message);
    }

    public function isValid(mixed $value): bool
    {
        if (is_numeric($value)) {
            return (float)$value <= $this->max;
        }
        if (is_string($value)) {
            return strlen($value) <= (int)$this->max;
        }
        return false;
    }

    public function message(string $field): string
    {
        return "{$this->upFirstLetter($field)} must have a value less than or equal to $this->max.";
    }
}

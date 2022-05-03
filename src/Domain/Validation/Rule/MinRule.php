<?php

namespace Domain\Validation\Rule;

class MinRule extends BaseRule
{
    public function __construct(
        private float|int $min,
        ?string $message = null
    ) {
        parent::__construct($message);
    }

    protected function isValid(mixed $value): bool
    {
        if (is_int($value)) {
            return $value >= $this->min;
        }
        if (is_float($this->min)) {
            return (float)$value >= $this->min;
        }
        if (is_string($value)) {
            return strlen($value) >= (int)$this->min;
        }
        return false;
    }

    public function message(string $field): string
    {
        return "{$this->upFirstLetter($field)} must have a value greater than or equal to $this->min.";
    }
}

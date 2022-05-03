<?php

namespace Domain\Validation\Rule;

use Domain\Validation\Error;

abstract class BaseRule implements Rule
{
    protected bool $forceValidateNullValue = false;

    public function __construct(protected ?string $message = null)
    {
    }

    abstract protected function isValid(mixed $value): bool;

    abstract public function message(string $field): string;

    public function validate(string $field, mixed $value, ?bool $validateNullValue = true): ?Error
    {
        if (!$validateNullValue && !$this->forceValidateNullValue) {
            return null;
        }
        if (!$this->isValid($value)) {
            return new Error($field, $this->message ?? $this->message($field));
        }
        return null;
    }

    protected function upFirstLetter(string $field): string
    {
        return ucfirst($field);
    }
}

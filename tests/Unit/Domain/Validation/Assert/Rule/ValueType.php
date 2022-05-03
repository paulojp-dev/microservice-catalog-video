<?php

namespace Tests\Unit\Domain\Validation\Assert\Rule;

enum ValueType: string
{
    case String = 'string';
    case Integer = 'integer';
    case Float = 'float';
    case Boolean = 'boolean';
    case DateTime = 'dateTime';

    public function isString(): bool
    {
        return $this === self::String;
    }
    public function isInteger(): bool
    {
        return $this === self::Integer;
    }
    public function isFloat(): bool
    {
        return $this === self::Float;
    }
    public function isBoolean(): bool
    {
        return $this === self::Boolean;
    }
    public function isDateTime(): bool
    {
        return $this === self::DateTime;
    }
}
<?php

namespace Infra\Lib\Shared;

enum PrimitiveType: string
{
    case Bool = 'bool';
    case Int = 'int';
    case Float = 'float';
    case String = 'string';
    case Array = 'array';
    case Object = 'object';
    case Callable = 'callable';
    case Iterable = 'iterable';

    public function isBool(): bool
    {
        return $this === self::Bool;
    }

    public function isInt(): bool
    {
        return $this === self::Int;
    }

    public function isFloat(): bool
    {
        return $this === self::Float;
    }

    public function isString(): bool
    {
        return $this === self::String;
    }

    public function isArray(): bool
    {
        return $this === self::Array;
    }

    public function isObject(): bool
    {
        return $this === self::Object;
    }

    public function isCallable(): bool
    {
        return $this === self::Callable;
    }

    public function isIterable(): bool
    {
        return $this === self::Iterable;
    }
}
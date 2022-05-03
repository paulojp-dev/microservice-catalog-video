<?php

namespace Tests\Unit\Infra\Lib\Shared;

use Infra\Lib\Shared\PrimitiveType;
use PHPUnit\Framework\TestCase;

class PrimitiveTypeUnitTest extends TestCase
{
    public function testMustBeTrueIfHasCorrectType(): void
    {
        $enumBool = PrimitiveType::Bool;
        $enumInt = PrimitiveType::Int;
        $enumFloat = PrimitiveType::Float;
        $enumString = PrimitiveType::String;
        $enumArray = PrimitiveType::Array;
        $enumObject = PrimitiveType::Object;
        $enumCallable = PrimitiveType::Callable;
        $enumIterable = PrimitiveType::Iterable;
        $this->assertTrue($enumBool->isBool());
        $this->assertTrue($enumInt->isInt());
        $this->assertTrue($enumFloat->isFloat());
        $this->assertTrue($enumString->isString());
        $this->assertTrue($enumArray->isArray());
        $this->assertTrue($enumObject->isObject());
        $this->assertTrue($enumCallable->isCallable());
        $this->assertTrue($enumIterable->isIterable());
    }

    public function testMustBeFalseIfNotCorrectType(): void
    {
        $enumBool = PrimitiveType::Iterable;
        $enumInt = PrimitiveType::Iterable;
        $enumFloat = PrimitiveType::Iterable;
        $enumString = PrimitiveType::Iterable;
        $enumArray = PrimitiveType::Iterable;
        $enumObject = PrimitiveType::Iterable;
        $enumCallable = PrimitiveType::Iterable;
        $enumIterable = PrimitiveType::Bool;
        $this->assertFalse($enumBool->isBool());
        $this->assertFalse($enumInt->isInt());
        $this->assertFalse($enumFloat->isFloat());
        $this->assertFalse($enumString->isString());
        $this->assertFalse($enumArray->isArray());
        $this->assertFalse($enumObject->isObject());
        $this->assertFalse($enumCallable->isCallable());
        $this->assertFalse($enumIterable->isIterable());
    }
}
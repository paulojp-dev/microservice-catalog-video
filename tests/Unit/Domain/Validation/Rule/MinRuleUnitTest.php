<?php

namespace Tests\Unit\Domain\Validation\Rule;

use Domain\Validation\Rule\MinRule;
use PHPUnit\Framework\TestCase;

class MinRuleUnitTest extends TestCase
{
    public function testMustReturnErrorIfValidIntValue(): void
    {
        $rule = new MinRule(min: 18);
        $error = $rule->validate(field: 'age', value: 18);
        $this->assertNull($error);
    }

    public function testMustReturnErrorIfInvalidIntValue(): void
    {
        $rule = new MinRule(min: 18);
        $error = $rule->validate(field: 'age', value: 17);
        $this->assertNotNull($error);
        $this->assertEquals('age', $error->getField());
        $this->assertEquals('Age must have a value greater than or equal to 18.', $error->getMessage());
    }

    public function testMustReturnErrorIfValidFloatValue(): void
    {
        $rule = new MinRule(min: 5.25);
        $error = $rule->validate(field: 'weight', value: 5.250);
        $this->assertNull($error);
    }

    public function testMustReturnErrorIfInvalidFloatValue(): void
    {
        $rule = new MinRule(min: 5.25);
        $error = $rule->validate(field: 'weight', value: 5.249);
        $this->assertNotNull($error);
        $this->assertEquals('weight', $error->getField());
        $this->assertEquals('Weight must have a value greater than or equal to 5.25.', $error->getMessage());
    }

    public function testMustReturnErrorIfValidStringValue(): void
    {
        $rule = new MinRule(min: 5);
        $error = $rule->validate(field: 'name', value: 'Hanna');
        $this->assertNull($error);
    }

    public function testMustReturnErrorIfInvalidStringValue(): void
    {
        $rule = new MinRule(min: 6);
        $error = $rule->validate(field: 'name', value: 'Hanna');
        $this->assertNotNull($error);
        $this->assertEquals('name', $error->getField());
        $this->assertEquals('Name must have a value greater than or equal to 6.', $error->getMessage());
    }

    public function testMustReturnErrorIfInvalidValueType(): void
    {
        $rule = new MinRule(min: 6);
        $error = $rule->validate(field: 'name', value: true);
        $this->assertNotNull($error);
    }
}

<?php

namespace Tests\Unit\Domain\Validation\Rule;

use Domain\Validation\Rule\MaxRule;
use PHPUnit\Framework\TestCase;

class MaxRuleUnitTest extends TestCase
{
    public function testMustNotReturnErrorIfValidIntValue(): void
    {
        $rule = new MaxRule(max: 18);
        $this->assertNull($rule->validate(field: 'age', value: 18));
    }

    public function testMustReturnErrorIfInvalidIntValue(): void
    {
        $rule = new MaxRule(max: 18);
        $error = $rule->validate(field: 'age', value: 19);
        $this->assertNotNull($error);
        $this->assertEquals('age', $error->getField());
        $this->assertEquals('Age must have a value less than or equal to 18.', $error->getMessage());
    }

    public function testMustNotReturnErrorIfValidStringValue(): void
    {
        $rule = new MaxRule(max: 4);
        $this->assertNull($rule->validate(field: 'name', value: 'Anna'));
    }

    public function testMustReturnErrorIfInvalidStringValue(): void
    {
        $rule = new MaxRule(max: 3);
        $error = $rule->validate(field: 'name', value: 'Anna');
        $this->assertNotNull($error);
        $this->assertEquals('name', $error->getField());
        $this->assertEquals('Name must have a value less than or equal to 3.', $error->getMessage());
    }

    public function testMustReturnErrorIfInvalidValueType(): void
    {
        $rule = new MaxRule(max: 3);
        $error = $rule->validate(field: 'name', value: false);
        $this->assertNotNull($error);
    }
}

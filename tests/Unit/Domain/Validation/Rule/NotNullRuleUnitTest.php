<?php

namespace Tests\Unit\Domain\Validation\Rule;

use Domain\Validation\Rule\NotNullRule;
use PHPUnit\Framework\TestCase;

class NotNullRuleUnitTest extends TestCase
{
    public function testMustNotReturnErrorWhenNotNullValue(): void
    {
        $rule = new NotNullRule();
        $this->assertNull($rule->validate(field: 'any_field', value: 'any_value'));
    }

    public function testMustReturnErrorWhenNullValue(): void
    {
        $rule = new NotNullRule();
        $error = $rule->validate(field: 'name', value: null);
        $this->assertNotNull($error);
        $this->assertEquals('name', $error->getField());
        $this->assertEquals('Name cannot be null.', $error->getMessage());
    }
}

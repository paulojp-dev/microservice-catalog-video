<?php

namespace Tests\Unit\Domain\Validation;

use Domain\Exception\ValidationException;
use Domain\Validation\AttributeValidator;
use Domain\Validation\Rule\MaxRule;
use Domain\Validation\Rule\MinRule;
use Domain\Validation\Rule\NotNullRule;
use PHPUnit\Framework\TestCase;

class AttributeValidatorUnitTest extends TestCase
{
    public function testMustNotThrowExceptionIfAllRulesPassSuccessfully(): void
    {
        AttributeValidator::validate(field: 'name', value: 'Mayk', nullable: false, rules: [
            new NotNullRule(),
            new MinRule(3),
            new MaxRule(100),
        ]);
        $this->assertTrue(true);
    }

    public function testMustNotThrowExceptionIfNotReceive(): void
    {
        AttributeValidator::validate(field: 'name', value: 'Mayk', nullable: false, rules: []);
        $this->assertTrue(true);
    }

    public function testMustReturnErrorIfSecondRuleFails(): void
    {
        $secondRule = new MinRule(5);
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage($secondRule->message('name'));
        AttributeValidator::validate(field: 'name', value: 'Mayk', nullable: false, rules: [
            new NotNullRule(),
            $secondRule,
            new MaxRule(100),
        ]);
    }

    public function testMustNotThrowExceptionIfSecondRuleFailsButValueCanBeNullable(): void
    {
        AttributeValidator::validate(field: 'name', value: null, nullable: true, rules: [
            new MinRule(3),
            new MaxRule(100),
        ]);
        $this->assertTrue(true);
    }

    public function testMustThrowExceptionIfFirstRuleFailsAndSetValueCanBeNullableButRuleForceValidateNull(): void
    {
        $firstRule = new NotNullRule();
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage($firstRule->message('name'));
        AttributeValidator::validate(field: 'name', value: null, nullable: true, rules: [
            $firstRule,
            new MinRule(3),
            new MaxRule(100),
        ]);
    }
}

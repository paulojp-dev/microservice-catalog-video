<?php

namespace Tests\Unit\Domain\Validation\Rule;

use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Validation\Rule\Stub\FooRuleStub;

class BaseRuleUnitTest extends TestCase
{
    public function testMustNotReturnErrorWhenValidationPassedSuccessfully(): void
    {
        $fooRule = $this->makeFooRuleStub(true);
        $error = $fooRule->validate('any_field', 'any_value');
        $this->assertNull($error);
    }

    public function testMustReturnErrorWhenValidationFailed(): void
    {
        $fooRule = $this->makeFooRuleStub(false);
        $error = $fooRule->validate('any_field', 'any_value');
        $this->assertNotNull($error);
        $this->assertEquals('any_field', $error->getField());
        $this->assertEquals('Fail.', $error->getMessage());
    }

    public function testMustReturnCustomErrorMessageWhenValidationFails(): void
    {
        $fooRule = $this->makeFooRuleStub(false, 'Custom error message.');
        $error = $fooRule->validate('any_field', 'any_value');
        $this->assertNotNull($error);
        $this->assertEquals('any_field', $error->getField());
        $this->assertEquals('Custom error message.', $error->getMessage());
    }

    public function testMustReturnErrorIfValidationFailedToPassNullValue(): void
    {
        $fooRule = $this->makeFooRuleStub(false);
        $error = $fooRule->validate('any_field', null);
        $this->assertNotNull($error);
        $this->assertEquals('any_field', $error->getField());
        $this->assertEquals('Fail.', $error->getMessage());
    }

    public function testMustMustIgnoreValidationIfSetFalseForValidateNullValue(): void
    {
        $fooRule = new FooRuleStub();
        $fooRule->setValidationResult(false);
        $error = $fooRule->validate('any_field', null, false);
        $this->assertNull($error);
    }

    public function testMustReturnErrorIfSetFalseForValidateNullAndRuleForceValidateNull(): void
    {
        $fooRule = $this->makeFooRuleStub(false);
        $fooRule->setForceValidateNullValue(true);
        $error = $fooRule->validate('any_field', null, false);
        $this->assertNotNull($error);
        $this->assertEquals('any_field', $error->getField());
        $this->assertEquals('Fail.', $error->getMessage());
    }

    private function makeFooRuleStub(bool $validationResult, ?string $customMessage = null): FooRuleStub
    {
        return (new FooRuleStub($customMessage))
            ->setValidationResult($validationResult)
            ->setMessage('Fail.');
    }
}

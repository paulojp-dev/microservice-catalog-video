<?php

namespace Tests\Unit\Domain\Validation\Rule\Stub;

use Domain\Validation\Rule\BaseRule;

class FooRuleStub extends BaseRule
{
    private bool $isValid = true;
    private string $msg = '';

    protected function isValid(mixed $value): bool
    {
        return $this->isValid;
    }

    public function message(string $field): string
    {
        return $this->msg;
    }

    public function setMessage(string $message): self
    {
        $this->msg = $message;
        return $this;
    }

    public function setValidationResult(bool $result): self
    {
        $this->isValid = $result;
        return $this;
    }

    public function setForceValidateNullValue(bool $validateNull): self
    {
        $this->forceValidateNullValue = $validateNull;
        return $this;
    }
}

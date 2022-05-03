<?php

namespace Tests\Unit\Domain\Validation\Assert\Rule;

use Domain\Validation\Rule\Rule;
use Infra\Lib\Shared\PrimitiveType;
use Tests\Unit\Domain\Validation\Assert\Rule\Scenario\ScenarioCollection;

abstract class BaseAssertRule implements AssertRule
{
    protected Rule $rule;

    public function __construct(
        protected ?string $customMessage = null
    ) {
        $this->rule = $this->instantiateRule();
    }

    abstract protected function instantiateRule(): Rule;

    final public function getScenarios(string $field, PrimitiveType $valueType): ScenarioCollection
    {
        $scenarios = $this->resolveScenarios($field, $valueType);
        if (empty($scenarios)) {
            throw $this->exceptionScenarioNotFound($field, $valueType);
        }
        return $scenarios;
    }

    private function resolveScenarios(string $field, PrimitiveType $valueType): ?ScenarioCollection
    {
        $message = $this->extractMessage($field);
        if ($valueType->isInt()) {
            return $this->intScenarios($message);
        }
        if ($valueType->isFloat()) {
            return $this->floatScenarios($message);
        }
        if ($valueType->isString()) {
            return $this->stringScenarios($message);
        }
        return null;
    }

    protected function extractMessage(string $field): string
    {
        return $this->customMessage ?? $this->rule->message($field);
    }

    protected function intScenarios(string $message): ?ScenarioCollection
    {
        return null;
    }

    protected function floatScenarios(string $message): ?ScenarioCollection
    {
        return null;
    }

    protected function stringScenarios(string $message): ?ScenarioCollection
    {
        return null;
    }

    private function exceptionScenarioNotFound(string $field, PrimitiveType $value): \Exception
    {
        $message = sprintf(
            "Scenario not found: field: %s, value type '%s' and rule: '%s'.",
            $field,
            $value->value,
            get_class($this->rule)
        );
        return new \Exception($message);
    }
}

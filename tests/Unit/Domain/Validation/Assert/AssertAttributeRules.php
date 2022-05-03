<?php

namespace Tests\Unit\Domain\Validation\Assert;

use Domain\Exception\ValidationException;
use Infra\Lib\Shared\PrimitiveType;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Validation\Assert\Rule\AssertRule;
use Tests\Unit\Domain\Validation\Assert\Rule\Scenario\Scenario;
use Tests\Unit\Domain\Validation\Assert\Rule\ValueType;

class AssertAttributeRules
{
    /**
     * @var \Closure[]
     */
    private array $callables;

    /**
     * @var AssertRule[]
     */
    private array $asserts;

    public function __construct(
        private TestCase $testCase,
        private string $field,
        private PrimitiveType $valueType
    ) {
    }

    public static function init(
        TestCase $testCase,
        string $field,
        PrimitiveType $valueType
    ): self {
        return new static($testCase, $field, $valueType);
    }

    public function callables(\Closure ...$callables): self
    {
        $this->callables = $callables;
        return $this;
    }

    public function rules(AssertRule ...$asserts): self
    {
        $this->asserts = $asserts;
        return $this;
    }

    public function assert(): void
    {
        foreach ($this->asserts as $rule) {
            $this->assertRule($rule);
        }
    }

    public function assertRule(AssertRule $rule): self
    {
        $scenarios = $rule->getScenarios($this->field, $this->valueType);
        foreach ($scenarios as $scenario) {
            foreach ($this->callables as $callable) {
                $this->assertScenario($scenario, $callable);
            }
        }
        return $this;
    }

    private function assertScenario(Scenario $scenario, callable $callable): void
    {
        try {
            call_user_func($callable, $scenario->getValue());
            $this->testCase->assertTrue(true);
        } catch (\Exception $e) {
            if (!$e instanceof ValidationException) {
                throw $e;
            }
            $message = sprintf(
                'Field: %s, scenario: %s',
                $this->field,
                $scenario->getDescription()
            );
            $this->testCase->assertEquals($scenario->getMessage(), $e->getMessage(), $message);
        }
    }
}

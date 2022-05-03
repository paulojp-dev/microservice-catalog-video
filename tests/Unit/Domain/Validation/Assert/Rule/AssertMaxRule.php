<?php

namespace Tests\Unit\Domain\Validation\Assert\Rule;

use Domain\Validation\Rule\MaxRule;
use Domain\Validation\Rule\Rule;
use Tests\Unit\Domain\Validation\Assert\Rule\Scenario\ScenarioCollection;
use Tests\Unit\Domain\Validation\Assert\Rule\Scenario\ScenarioMessage;

class AssertMaxRule extends BaseAssertRule
{
    public function __construct(
        private int|float $max,
        ?string $customMessage = null
    ) {
        parent::__construct($customMessage);
        $this->customMessage = $customMessage;
    }

    protected function stringScenarios(string $message): ?ScenarioCollection
    {
        return ScenarioCollection::init($this->rule)
            ->error(
                description: ScenarioMessage::ValueAboveExpected,
                value: str_repeat('a', ($this->max + 1)),
                message: $message
            )
            ->success(
                description: ScenarioMessage::ValueEqualToExpected,
                value: str_repeat('a', $this->max)
            );
    }

    protected function floatScenarios(string $message): ?ScenarioCollection
    {
        return $this->intScenarios($message);
    }

    protected function intScenarios(string $message): ?ScenarioCollection
    {
        return ScenarioCollection::init($this->rule)
            ->error(
                description: ScenarioMessage::ValueAboveExpected,
                value: $this->max + 0.001,
                message: $message
            )
            ->success(
                description: ScenarioMessage::ValueEqualToExpected,
                value: $this->max
            );
    }

    protected function instantiateRule(): Rule
    {
        return new MaxRule($this->max, $this->customMessage);
    }
}

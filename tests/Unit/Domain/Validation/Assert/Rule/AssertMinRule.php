<?php

namespace Tests\Unit\Domain\Validation\Assert\Rule;

use Domain\Validation\Rule\MinRule;
use Domain\Validation\Rule\Rule;
use Tests\Unit\Domain\Validation\Assert\Rule\Scenario\ScenarioCollection;
use Tests\Unit\Domain\Validation\Assert\Rule\Scenario\ScenarioMessage;

class AssertMinRule extends BaseAssertRule
{
    public function __construct(
        private float|int $min,
        protected ?string $customMessage = null
    ) {
        parent::__construct($this->customMessage);
    }

    protected function stringScenarios(string $message): ScenarioCollection
    {
        return ScenarioCollection::init($this->rule)
            ->error(
                description: ScenarioMessage::ValueBelowExpected,
                value: str_repeat('a', ($this->min - 1)),
                message: $message
            )
            ->success(
                description: ScenarioMessage::ValueEqualToExpected,
                value: str_repeat('a', $this->min)
            );
    }

    protected function intScenarios(string $message): ScenarioCollection
    {
        return $this->floatScenarios($message);
    }

    protected function floatScenarios(string $message): ScenarioCollection
    {
        return ScenarioCollection::init($this->rule)
            ->error(
                description: ScenarioMessage::ValueBelowExpected,
                value: $this->min - 0.001,
                message: $message
            )
            ->success(
                description: ScenarioMessage::ValueEqualToExpected,
                value: $this->min
            );
    }

    protected function instantiateRule(): Rule
    {
        return new MinRule($this->min, $this->customMessage);
    }
}

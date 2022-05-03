<?php

namespace Tests\Unit\Domain\Validation\Assert\Rule;

use Domain\Validation\Rule\Rule;
use Domain\Validation\Rule\UuidRule;
use Tests\Unit\Domain\Validation\Assert\Rule\Scenario\ScenarioCollection;

class AssertUuidRule extends BaseAssertRule
{
    protected function stringScenarios(string $message): ?ScenarioCollection
    {
        return ScenarioCollection::init($this->rule)
            ->error(description: 'invalid uuid', value: 'invalid_uuid', message: $message);
    }

    protected function instantiateRule(): Rule
    {
        return new UuidRule($this->customMessage);
    }
}

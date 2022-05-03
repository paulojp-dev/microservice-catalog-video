<?php

namespace Tests\Unit\Domain\Validation\Assert\Rule;

use Infra\Lib\Shared\PrimitiveType;
use Tests\Unit\Domain\Validation\Assert\Rule\Scenario\ScenarioCollection;

interface AssertRule
{
    public function getScenarios(string $field, PrimitiveType $valueType): ScenarioCollection;
}

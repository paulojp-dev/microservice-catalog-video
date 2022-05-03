<?php

namespace Tests\Unit\Domain\Validation\Assert\Rule\Scenario;

enum ScenarioMessage: string
{
    case ValueAboveExpected = 'value above expected';
    case ValueBelowExpected = 'value below expected';
    case ValueEqualToExpected = 'value equal to expected';
}
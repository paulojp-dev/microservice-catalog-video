<?php

namespace Tests\Unit\Domain\Validation\Rule;

use Domain\Validation\Rule\UuidRule;
use PHPUnit\Framework\TestCase;

class UuidRuleUnitTest extends TestCase
{
    public function testMustPassIfValidUuid(): void
    {
        $error = (new UuidRule())->validate(field: 'uuid', value: 'd5eb9562-5ad9-4813-8918-8d5d62d6c905');
        $this->assertNull($error);
    }

    public function testMustReturnErrorInvalidUuid(): void
    {
        $error = (new UuidRule())->validate(field: 'uuid', value: 'invalid');
        $this->assertNotNull($error);
        $this->assertEquals('uuid', $error->getField());
        $this->assertEquals('Invalid uuid.', $error->getMessage());
    }
}
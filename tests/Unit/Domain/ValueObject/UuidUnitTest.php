<?php

namespace Tests\Unit\Domain\ValueObject;

use Domain\ValueObject\Uuid;
use Infra\Lib\Shared\PrimitiveType;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Validation\Assert\AssertAttributeRules;
use Tests\Unit\Domain\Validation\Assert\Rule\AssertUuidRule;

class UuidUnitTest extends TestCase
{
    public function testCreateUuid(): void
    {
        $value = 'd5eb9562-5ad9-4813-8918-8d5d62d6c905';
        $uuid = new Uuid($value);
        $this->assertEquals($value, (string)$uuid);
        $this->assertEquals($value, $uuid->value());
    }

    public function testUuidValidation(): void
    {
        AssertAttributeRules::init(testCase: $this, field: 'uuid', valueType: PrimitiveType::String)
            ->callables(fn (string $value) => new Uuid('invalid_uuid'))
            ->rules(new AssertUuidRule())
            ->assert();
    }

    public function testMustGenerateRandomId(): void
    {
        $uuid = Uuid::random();
        $this->assertNotNull($uuid);
        $this->assertInstanceOf(Uuid::class, $uuid);
    }
}

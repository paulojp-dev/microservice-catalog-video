<?php

namespace Tests\Unit\Infra\Adapter\Uuid;

use Infra\Adapter\Uuid\UuidAdapter;
use PHPUnit\Framework\TestCase;

class UuidAdapterUnitTest extends TestCase
{
    public function testMustRandomUuid(): void
    {
        $uuid = UuidAdapter::random();
        $this->assertNotNull($uuid);
    }

    public function testMustBeValid(): void
    {
        $isValid = UuidAdapter::isValid(UuidAdapter::random());
        $this->assertTrue($isValid);
    }

    public function testMustBeInvalid(): void
    {
        $isValid = UuidAdapter::isValid('invalid');
        $this->assertFalse($isValid);
    }
}
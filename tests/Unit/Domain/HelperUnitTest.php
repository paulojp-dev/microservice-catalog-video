<?php

namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;

class HelperUnitTest extends TestCase
{
    public function testArrayFirstMustReturnFirstElement(): void
    {
        $arr = ['x', 'y', 'z'];
        $this->assertEquals('x', array_first($arr));
    }

    public function testArrayFirstMustReturnNullIfEmptyArr(): void
    {
        $arr = [];
        $this->assertNull(array_first($arr));
    }

    public function testArrayLastMustReturnLastElement(): void
    {
        $arr = ['x', 'y', 'z'];
        $this->assertEquals('z', array_last($arr));
    }

    public function testArrayLastMustReturnNullIfEmptyArr(): void
    {
        $arr = [];
        $this->assertNull(array_last($arr));
    }

    public function testArrayHastMustBeTrueIfHasKey(): void
    {
        $arr = ['name' => 'Anna'];
        $this->assertTrue(array_has($arr, 'name'));
    }

    public function testArrayHastMustBeFalseIfNotHasKey(): void
    {
        $arr = ['name' => 'Anna'];
        $this->assertFalse(array_has($arr, 'age'));
    }

    public function testNowMustReturnActualDateTime(): void
    {
        $actualDateTime = now();
        $this->assertNotNull($actualDateTime);
    }
}
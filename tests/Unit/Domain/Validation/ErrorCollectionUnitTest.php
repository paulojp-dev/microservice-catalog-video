<?php

namespace Tests\Unit\Domain\Validation;

use Domain\Validation\Error;
use Domain\Validation\ErrorCollection;
use PHPUnit\Framework\TestCase;

class ErrorCollectionUnitTest extends TestCase
{
    public function testEmptyCollection(): void
    {
        $collection = (new ErrorCollection());
        $this->assertEmpty($collection->toArray());
        $this->assertEquals(0, $collection->count());
    }

    public function testAddErrors(): void
    {
        $collection = (new ErrorCollection())
            ->add(new Error(field: 'f1', message: 'm1'))
            ->add(new Error(field: 'f2', message: 'm2'));
        $this->assertEquals([['f1' => 'm1'], ['f2' => 'm2']], $collection->toArray());
        $this->assertEquals(2, $collection->count());
    }
}

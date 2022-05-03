<?php

namespace Tests\Unit\Infra\Lib\Collection;

use Infra\Lib\Collection\ObjectCollection;
use Infra\Lib\Collection\PrimitiveTypeCollection;
use Infra\Lib\Shared\PrimitiveType;
use PHPUnit\Framework\TestCase;

class CollectionUnitTest extends TestCase
{
    public function testMustAddElementsToPrimitiveTypeCollection(): void
    {
        $collection = $this->stringCollection();
        $collection[] = 'banana';
        $collection[] = 'apple';
        $this->assertEquals('banana', $collection[0]);
        $this->assertEquals('apple', $collection[1]);
    }

    public function testMustAddElementsToObjectCollection(): void
    {
        $collection = $this->dateTimeCollection();
        $collection[] = new \DateTime('2000-01-01');
        $collection[] = new \DateTime('2002-02-02');
        $this->assertEquals('2000-01-01', $collection[0]->format('Y-m-d'));
        $this->assertEquals('2002-02-02', $collection[1]->format('Y-m-d'));
    }

    public function testMustThrowExceptionIfPutDifferentPrimitiveType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Collection value must be type of 'string'.");
        $collection = $this->stringCollection();
        $collection[] = 1;
    }

    public function testMustThrowExceptionIfPutDifferentObjectType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Collection value must be instance of 'DateTime'.");
        $collection = $this->dateTimeCollection();
        $collection[] = 'string';
    }

    public function testMustBeEmptyIfNotGivenAnyValue(): void
    {
        $collection = $this->stringCollection();
        $this->assertTrue($collection->isEmpty());
    }

    public function testMustBeNotEmptyIfGivenAnyValue(): void
    {
        $collection = $this->stringCollection();
        $collection[] = 'house';
        $this->assertFalse($collection->isEmpty());
    }

    public function testMustCountQuantityOfElements(): void
    {
        $collection = $this->stringCollection();
        $this->assertCount(0, $collection);
        $collection[] = 'banana';
        $collection[] = 'apple';
        $this->assertCount(2, $collection);
    }

    public function testMustCreateFromArray(): void
    {
        $array = ['banana', 'apple'];
        $collection = $this->stringCollection()::fromArray($array);
        $this->assertEquals('banana', $collection[0]);
        $this->assertEquals('apple', $collection[1]);
    }

    public function testToArray(): void
    {
        $array = [
            new \DateTime('2000-01-01'),
            new \DateTime('2002-02-02'),
        ];
        $collection = $this->dateTimeCollection()::fromArray($array);
        $this->assertEquals($array, $collection->toArray());
    }

    public function testForeach(): void
    {
        $array = ['orange', 'apple', 'banana'];
        $collection = $this->stringCollection()::fromArray($array);
        foreach ($collection as $key => $element) {
            $this->assertEquals($array[$key], $element);
        }
    }

    public function testMap(): void
    {
        $array = ['orange', 'apple', 'banana'];
        $collection = $this->stringCollection()::fromArray($array);
        $result = $collection->map(fn (string $s) => strlen($s));
        $this->assertEquals([6, 5, 6], $result);
    }

    public function testFilter(): void
    {
        $array = ['orange', 'apple', 'banana'];
        $collection = $this->stringCollection()::fromArray($array);
        $result = $collection->filter(fn (string $s) => strlen($s) >= 6);
        $this->assertEquals(['orange', 'banana'], $result->toArray());
    }

    public function testReduce(): void
    {
        $array = ['orange', 'apple', 'banana'];
        $collection = $this->stringCollection()::fromArray($array);
        $result = $collection->reduce(function (int $acc, string $s) {
            $acc += strlen($s);
            return $acc;
        }, 0);
        $this->assertEquals(17, $result);
    }

    private function stringCollection(): PrimitiveTypeCollection
    {
        return new class() extends PrimitiveTypeCollection {
            public function current(): ?string
            {
                return parent::current();
            }

            public function offsetGet($offset): ?string
            {
                return parent::offsetGet($offset);
            }

            protected function primitiveType(): PrimitiveType
            {
                return PrimitiveType::String;
            }
        };
    }

    private function dateTimeCollection(): ObjectCollection
    {
        return new class() extends ObjectCollection {
            public function current(): ?\DateTime
            {
                return parent::current();
            }

            public function offsetGet($offset): ?\DateTime
            {
                return parent::offsetGet($offset);
            }

            protected function objectClass(): string
            {
                return \DateTime::class;
            }
        };
    }
}

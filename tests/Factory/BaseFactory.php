<?php

namespace Tests\Factory;

use Faker\Factory;
use Faker\Generator;

abstract class BaseFactory
{
    protected Generator $faker;

    public function __construct(protected ?array $attrs = [])
    {
        $this->faker = Factory::create();
    }

    public function make(): mixed
    {
        $fullData = array_merge($this->data(), $this->attrs ?? []);
        $class = $this->entityClass();
        return new $class(...$fullData);
    }

    abstract protected function entityClass(): string;

    abstract protected function data(): array;

    public static function init(?array $attrs = []): static
    {
        return new static($attrs);
    }
}

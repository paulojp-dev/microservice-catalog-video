<?php

namespace Tests\Factory;

use Domain\Entity\Category;
use Domain\ValueObject\Uuid;

/**
 * @method Category make()
 */
class CategoryFactory extends BaseFactory
{
    protected function entityClass(): string
    {
        return Category::class;
    }

    protected function data(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->name,
            'isActive' => $this->faker->randomElement([true, false]),
            'id' => new Uuid($this->faker->uuid),
        ];
    }
}

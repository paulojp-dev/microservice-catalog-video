<?php

namespace Tests\Unit\Domain\Entity;

use Domain\Entity\Category;
use Domain\ValueObject\Uuid;
use Infra\Lib\Shared\PrimitiveType;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Validation\Assert\AssertAttributeRules;
use Tests\Unit\Domain\Validation\Assert\Rule\AssertMaxRule;
use Tests\Unit\Domain\Validation\Assert\Rule\AssertMinRule;

class CategoryUnitTest extends TestCase
{
    public function testGettersReturn(): void
    {
        $uuid = Uuid::random();
        $createDate = new \DateTime('2000-01-01');
        $category = new Category(
            name: 'New Name',
            description: 'New Description',
            id: $uuid,
            createdAt: $createDate
        );
        $this->assertEquals($uuid, $category->getId());
        $this->assertEquals('New Name', $category->getName());
        $this->assertEquals('New Description', $category->getDescription());
        $this->assertEquals($createDate, $category->getCreatedAt());
        $this->assertTrue($category->isActive());
    }

    public function testSetRandomIdIfNotSet(): void
    {
        $category = new Category(
            name: 'New Name',
            description: 'New Description',
        );
        $this->assertNotNull($category->getId());
    }

    public function testMustSetCurrentDateForCreatedAtFieldIfNotPassValue(): void
    {
        $category = new Category(
            name: 'New Name',
            description: 'New Description',
        );
        $this->assertEquals(now()->format('Y-m-d'), $category->getCreatedAt()->format('Y-m-d'));
    }

    public function testMustBeActivated(): void
    {
        $category = new Category(
            name: 'New Name',
            description: 'New Description',
            isActive: false,
        );
        $category->activate();
        $this->assertTrue($category->isActive());
    }

    public function testMustBeInactivated(): void
    {
        $category = new Category(
            name: 'New Name',
            description: 'New Description',
            isActive: true,
        );
        $category->inactivate();
        $this->assertFalse($category->isActive());
    }

    public function testMustBeUpdated(): void
    {
        $uuid = Uuid::random();
        $category = new Category(
            name: 'Old Name',
            description: 'Old Description',
            isActive: false,
            id: $uuid,
        );
        $category
            ->setName('New Name')
            ->setDescription('New Description')
            ->activate();
        $this->assertEquals($uuid, $category->getId());
        $this->assertEquals('New Name', $category->getName());
        $this->assertEquals('New Description', $category->getDescription());
        $this->assertTrue($category->isActive());
    }

    public function testDescriptionValidation(): void
    {
        $constructor = fn (mixed $value) => new Category(name: 'Default Name', description: $value);
        $setter = function (mixed $value) {
            $category = new Category(name: 'Default Name', description: 'Default Description');
            $category->setDescription($value);
        };
        AssertAttributeRules::init($this, 'description', PrimitiveType::String)
            ->callables($setter, $constructor)
            ->rules(new AssertMinRule(min: 3), new AssertMaxRule(max: 255))
            ->assert();
    }

    public function testNameValidation(): void
    {
        $constructor = fn (mixed $value) => new Category(name: $value, description: 'Default Description');
        $setter = function (mixed $value) {
            $category = new Category(name: 'Default Name', description: 'Default Description');
            $category->setName($value);
        };
        AssertAttributeRules::init($this, 'name', PrimitiveType::String)
            ->callables($setter, $constructor)
            ->rules(new AssertMinRule(min: 3), new AssertMaxRule(max: 255))
            ->assert();
    }
}

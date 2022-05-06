<?php

namespace Tests\Unit\Domain\UseCase\Category;

use Domain\Repository\ICategoryRepository;
use Domain\UseCase\Category\GetCategoryUseCase;
use Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;
use Tests\Factory\CategoryFactory;

class GetCategoryUseCaseUnitTest extends TestCase
{
    public function testMustLGetCategoryById(): void
    {
        $repositoryMock = \Mockery::mock(ICategoryRepository::class);
        $uuid = Uuid::random();
        $category = CategoryFactory::init(['id' => $uuid])->make();
        $repositoryMock->shouldReceive('find')->withArgs([$uuid->value()])->andReturn($category);
        $useCase = new GetCategoryUseCase($repositoryMock);
        $output = $useCase->exec($uuid);
        $this->assertEquals($category->getId(), $output->id);
        $this->assertEquals($category->getName(), $output->name);
        $this->assertEquals($category->getDescription(), $output->description);
        $this->assertEquals($category->isActive(), $output->isActive);
    }
}

<?php

namespace Tests\Unit\Domain\UseCase\Category;

use Domain\Repository\ICategoryRepository;
use Domain\UseCase\Category\DTO\SaveCategoryInput;
use Domain\UseCase\Category\SaveCategoryUseCase;
use PHPUnit\Framework\TestCase;
use Tests\Factory\CategoryFactory;

class SaveCategoryUseCaseUnitTest extends TestCase
{
    public function testMustCreateCategory(): void
    {
        $repositoryMock = \Mockery::mock(\stdClass::class, ICategoryRepository::class);
        $category = CategoryFactory::init()->make();
        $repositoryMock->shouldReceive('save')->withAnyArgs()->andReturn($category);
        $useCase = new SaveCategoryUseCase($repositoryMock);
        $output = $useCase->exec(new SaveCategoryInput(
            name: 'any_name',
            description: 'any_description',
            isActive: true,
        ));
        $this->assertEquals($category->getId(), $output->id);
        $this->assertEquals($category->getName(), $output->name);
        $this->assertEquals($category->getDescription(), $output->description);
        $this->assertEquals($category->isActive(), $output->isActive);
    }
}

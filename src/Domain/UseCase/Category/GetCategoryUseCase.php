<?php

namespace Domain\UseCase\Category;

use Domain\Repository\ICategoryRepository;
use Domain\UseCase\Category\DTO\GetCategoryOutput;

class GetCategoryUseCase
{
    public function __construct(
        private ICategoryRepository $categoryRepository
    ) {
    }

    public function exec(string $id): GetCategoryOutput
    {
        $category = $this->categoryRepository->find($id);
        return new GetCategoryOutput(
            id: $category->getId(),
            name: $category->getName(),
            description: $category->getDescription(),
            isActive: $category->isActive()
        );
    }
}

<?php

namespace Domain\UseCase\Category;

use Domain\Entity\Category;
use Domain\Repository\ICategoryRepository;
use Domain\UseCase\Category\DTO\SaveCategoryInput;
use Domain\UseCase\Category\DTO\SaveCategoryOutput;

class SaveCategoryUseCase
{
    public function __construct(
        private ICategoryRepository $categoryRepository
    ) {
    }

    public function exec(SaveCategoryInput $input): SaveCategoryOutput
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive
        );
        $savedCategory = $this->categoryRepository->save($category);
        return new SaveCategoryOutput(
            id: $savedCategory->getId(),
            name: $savedCategory->getName(),
            description: $savedCategory->getDescription(),
            isActive: $savedCategory->isActive()
        );
    }
}

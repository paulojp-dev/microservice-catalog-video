<?php

namespace Domain\UseCase\Category\DTO;

class SaveCategoryInput
{
    public function __construct(
        public string $name,
        public ?string $description = null,
        public ?bool $isActive = true,
    ) {
    }
}

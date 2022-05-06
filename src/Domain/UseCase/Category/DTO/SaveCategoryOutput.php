<?php

namespace Domain\UseCase\Category\DTO;

class SaveCategoryOutput
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public bool $isActive,
    ) {
    }
}
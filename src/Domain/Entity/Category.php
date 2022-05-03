<?php

namespace Domain\Entity;

use Domain\Validation\AttributeValidator;
use Domain\Validation\Rule\MaxRule;
use Domain\Validation\Rule\MinRule;

class Category
{
    public function __construct(
        private string $name,
        private string $description,
        private ?bool $isActive = true,
        private ?string $id = null,
    ) {
        $this->validateName($name);
        $this->validateDescription($description);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->validateName($name);
        $this->name = $name;
        return $this;
    }

    private function validateName(string $name): void
    {
        AttributeValidator::validate(field: 'name', value: $name, nullable: false, rules: [
            new MinRule(min: 3),
            new MaxRule(max: 255),
        ]);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->validateDescription($description);
        $this->description = $description;
        return $this;
    }

    private function validateDescription(string $description): void
    {
        AttributeValidator::validate(field: 'description', value: $description, nullable: false, rules: [
            new MinRule(min: 3),
            new MaxRule(max: 255),
        ]);
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function inactivate(): void
    {
        $this->isActive = false;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}

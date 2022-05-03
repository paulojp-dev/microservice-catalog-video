<?php

namespace Domain\ValueObject;

use Domain\Validation\AttributeValidator;
use Domain\Validation\Rule\UuidRule;
use Infra\Adapter\Uuid\UuidAdapter;

class Uuid
{
    public function __construct(
        protected string $value
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        AttributeValidator::validate(field:'uuid', value: $this->value, nullable: false, rules: [
            new UuidRule()
        ]);
    }

    public static function random(): self
    {
        return new self(UuidAdapter::random());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

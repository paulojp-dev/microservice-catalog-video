<?php

namespace Tests\Unit\Domain\Validation\Assert\Rule\Scenario;

class Scenario
{
    public function __construct(
        private string $description,
        private mixed $value,
        private ?string $message,
        private bool $fail
    ) {
    }

    public static function withError(string $description, mixed $value, string $message): self
    {
        return new static($description, $value, $message, fail: true);
    }

    public static function withoutError(string $description, mixed $value): self
    {
        return new static($description, $value, null, fail: true);
    }

    public function fail(): bool
    {
        return $this->fail;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [
            $this->description => [
                'value' => $this->value,
                'message' => $this->message,
                'fail' => $this->fail
            ]
        ];
    }
}

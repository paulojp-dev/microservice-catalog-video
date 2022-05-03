<?php

namespace Domain\Validation;

class ErrorCollection
{
    /** 
     * @var Error[]
     */
    private array $errors = [];

    public function add(Error $error): self
    {
        $this->errors[] = $error;
        return $this;
    }

    public function toArray(): array
    {
        return array_map(
            fn (Error $err) => [$err->getField() => $err->getMessage()],
            $this->errors
        );
    }

    public function count(): int
    {
        return count($this->errors);
    }
}

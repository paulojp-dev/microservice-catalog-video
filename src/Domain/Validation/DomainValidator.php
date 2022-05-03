<?php

namespace Domain\Validation;

interface DomainValidator
{
    public static function validate(string $field, mixed $value, bool $nullable, array $rules): void;
}
<?php

namespace Domain\Validation\Rule;

use Domain\Validation\Error;

interface Rule
{
    public function validate(string $field, mixed $value, ?bool $validateNullValue = true): ?Error;
}

<?php

namespace Domain\Validation;

use Domain\Exception\ValidationException;
use Domain\Validation\Rule\Rule;

class AttributeValidator implements DomainValidator
{
    /**
     * @param string $field
     * @param mixed $value
     * @param bool|null $nullable
     * @param Rule[] ...$rules
     * @throws ValidationException
     */
    public static function validate(string $field, mixed $value, bool $nullable, array $rules): void
    {
        $validator = new static();
        $validator->applyRules($field, $value, $nullable, $rules);
    }

    private function applyRules(string $field, mixed $value, bool $nullable, array $rules): void
    {
        foreach ($rules as $rule) {
            $error = $rule->validate($field, $value, validateNullValue: !$nullable);
            if ($error) {
                throw new ValidationException($error->getMessage());
            }
        }
    }
}

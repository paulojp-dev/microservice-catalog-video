<?php

namespace Tests\Unit\Domain\Validation;

use Domain\Validation\Error;
use PHPUnit\Framework\TestCase;

class ValidationErrorUnitTest extends TestCase
{
    public function testGettersReturn(): void
    {
        $error = new Error(field: 'any_field', message: 'any_message');
        $this->assertEquals('any_field', $error->getField());
        $this->assertEquals('any_message', $error->getMessage());
    }
}

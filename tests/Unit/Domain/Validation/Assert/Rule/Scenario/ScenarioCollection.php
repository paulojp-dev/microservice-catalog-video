<?php

namespace Tests\Unit\Domain\Validation\Assert\Rule\Scenario;

use function array_last;
use Domain\Validation\Rule\Rule;
use Infra\Lib\Collection\ObjectCollection;

class ScenarioCollection extends ObjectCollection
{
    private string $ruleClassName;

    public function __construct(Rule $rule)
    {
        parent::__construct();
        $this->ruleClassName = $this->extractClassName($rule);
    }

    public static function init(Rule $rule): self
    {
        return new static($rule);
    }

    public function error(ScenarioMessage|string $description, mixed $value, string $message): self
    {
        $this[] = Scenario::withError(
            description: $this->resolveDescription($description),
            value: $value,
            message: $message
        );
        return $this;
    }

    public function success(ScenarioMessage|string $description, mixed $value): self
    {
        $this[] = Scenario::withoutError(
            description: $this->resolveDescription($description),
            value: $value,
        );
        return $this;
    }

    private function resolveDescription(ScenarioMessage|string $description): string
    {
        $descriptionStr = is_string($description) ? $description : $description->value;
        return "$this->ruleClassName: $descriptionStr";
    }

    private function extractClassName(object $obj): mixed
    {
        return array_last(explode('\\', get_class($obj)));
    }

    public function current(): ?Scenario
    {
        return parent::current();
    }

    public function offsetGet($offset): ?Scenario
    {
        return parent::offsetGet($offset);
    }

    protected function objectClass(): string
    {
        return Scenario::class;
    }

    public function getRuleClassName(): string
    {
        return $this->ruleClassName;
    }
}

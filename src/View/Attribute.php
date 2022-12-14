<?php

namespace WireUi\View;

use Illuminate\Support\{Collection, Str};

final class Attribute
{
    private readonly string $directive;

    private readonly mixed $expression;

    private readonly ?string $name;

    private readonly ?string $value;

    private readonly Collection $modifiers;

    public function __construct(string $directive, mixed $expression = null)
    {
        $this->directive  = $directive;
        $this->expression = $expression;
        $this->name       = $this->extractName();
        $this->value      = $this->extractValue();
        $this->modifiers  = $this->extractModifiers();
    }

    private function extractName(): ?string
    {
        return Str::of($this->directive)->before(':')->before('.');
    }

    private function extractValue(): ?string
    {
        if (!str_contains($this->directive, ':')) {
            return null;
        }

        return Str::of($this->directive)->after(':')->before('.');
    }

    private function extractModifiers(): Collection
    {
        return Str::of($this->directive)
            ->explode('.')
            ->filter()
            ->unique()
            ->skip(1)
            ->values();
    }

    public function hasModifier(string $modifier): bool
    {
        return $this->modifiers()->contains($modifier);
    }

    public function directive(): string
    {
        return $this->directive;
    }

    public function expression(): mixed
    {
        return $this->expression;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public function modifiers(): Collection
    {
        return $this->modifiers;
    }
}

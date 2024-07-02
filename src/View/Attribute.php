<?php

namespace WireUi\View;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * This class is a refactored version of Livewire\WireDirective
 *
 * @see https://github.com/livewire/livewire/blob/main/src/WireDirective.php
 */
final class Attribute
{
    private readonly ?string $name;

    private readonly ?string $value;

    private readonly string $directive;

    private readonly mixed $expression;

    private readonly Collection $modifiers;

    public function __construct(string $directive, mixed $expression = null)
    {
        $this->directive = $directive;

        $this->expression = $expression;

        $this->name = $this->extractName();

        $this->value = $this->extractValue();

        $this->modifiers = $this->extractModifiers();
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public function directive(): string
    {
        return $this->directive;
    }

    public function expression(): mixed
    {
        return $this->expression;
    }

    public function modifiers(): Collection
    {
        return $this->modifiers;
    }

    public function hasModifier(string $modifier): bool
    {
        return $this->modifiers()->contains($modifier);
    }

    private function extractName(): ?string
    {
        return Str::of($this->directive)->before(':')->before('.');
    }

    private function extractValue(): ?string
    {
        if (! Str::contains($this->directive, ':')) {
            return null;
        }

        return Str::of($this->directive)->after(':')->before('.');
    }

    private function extractModifiers(): Collection
    {
        return Str::of($this->directive)->explode('.')->filter()->unique()->skip(1)->values();
    }
}

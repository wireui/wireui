<?php

namespace WireUi\View;

use Illuminate\Support\{Collection, Str};

final class Attribute
{
    /**
     * The attribute name.
     */
    private readonly ?string $name;

    /**
     * The attribute value.
     */
    private readonly ?string $value;

    /**
     * The attribute directive.
     */
    private readonly string $directive;

    /**
     * The attribute expression.
     */
    private readonly mixed $expression;

    /**
     * The attribute modifiers.
     */
    private readonly Collection $modifiers;

    /**
     * Create a new attribute instance.
     */
    public function __construct(string $directive, mixed $expression = null)
    {
        $this->directive  = $directive;
        $this->expression = $expression;
        $this->name       = $this->extractName();
        $this->value      = $this->extractValue();
        $this->modifiers  = $this->extractModifiers();
    }

    /**
     * Get the attribute name.
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * Get the attribute value.
     */
    public function value(): ?string
    {
        return $this->value;
    }

    /**
     * Get the attribute directive.
     */
    public function directive(): string
    {
        return $this->directive;
    }

    /**
     * Get the attribute expression.
     */
    public function expression(): mixed
    {
        return $this->expression;
    }

    /**
     * Get the attribute modifiers.
     */
    public function modifiers(): Collection
    {
        return $this->modifiers;
    }

    /**
     * Check if the attribute has a modifier.
     */
    public function hasModifier(string $modifier): bool
    {
        return $this->modifiers()->contains($modifier);
    }

    /**
     * Extract the attribute name.
     */
    private function extractName(): ?string
    {
        return Str::of($this->directive)->before(':')->before('.');
    }

    /**
     * Extract the attribute value.
     */
    private function extractValue(): ?string
    {
        if (!str_contains($this->directive, ':')) {
            return null;
        }

        return Str::of($this->directive)->after(':')->before('.');
    }

    /**
     * Extract the attribute modifiers.
     */
    private function extractModifiers(): Collection
    {
        return Str::of($this->directive)->explode('.')->filter()->unique()->skip(1)->values();
    }
}

<?php

namespace WireUi\Traits\Components;

trait HasSetupWrapper
{
    use HasSetupForm;

    protected function except(): array
    {
        return [];
    }

    protected function exclude(): array
    {
        return [];
    }

    protected function include(): array
    {
        return ['cy', 'id', 'dusk', 'name', 'type', 'value', 'x-on:', 'x-ref', 'x-model', 'disabled', 'readonly', 'required', 'wire:model', 'placeholder', 'autocomplete'];
    }

    protected function setupWrapper(array &$data): void
    {
        $wrapper = clone $this->attributes;

        $data['wrapper'] = $wrapper
            ->whereDoesntStartWith($this->except())
            ->filter(fn ($value) => ! is_array($value));
    }

    protected function finishWrapper(array &$data): void
    {
        $data['config'] = $this->config;

        $input = clone $data['attributes'];

        $data['input'] = $input
            ->whereStartsWith($this->include())
            ->whereDoesntStartWith($this->exclude())
            ->filter(fn ($value) => ! is_array($value));
    }
}

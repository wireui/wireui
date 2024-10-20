<?php

namespace WireUi\Traits\Components;

use WireUi\Attributes\Finish;
use WireUi\Attributes\Mount;

trait InteractsWithWrapper
{
    use InteractsWithForm;

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
        return [
            'cy',
            'id',
            'max',
            'min',
            'dusk',
            'name',
            'step',
            'type',
            'value',
            'x-on:',
            'x-ref',
            'x-model',
            'disabled',
            'readonly',
            'required',
            'wire:model',
            'placeholder',
            'autocomplete',
        ];
    }

    #[Mount(20)]
    protected function mountWrapper(array &$data): void
    {
        $wrapper = clone $this->attributes;

        $data['wrapper'] = $wrapper
            ->whereDoesntStartWith($this->except())
            ->filter(fn ($value) => ! is_array($value));
    }

    #[Finish(10)]
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

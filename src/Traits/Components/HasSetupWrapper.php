<?php

namespace WireUi\Traits\Components;

trait HasSetupWrapper
{
    use HasSetupForm;

    protected function except(): array
    {
        return [];
    }

    protected function setupWrapper(array &$data): void
    {
        $wrapper = clone $this->attributes;

        $data['wrapper'] = $wrapper->filter(function ($value) {
            return ! is_array($value);
        })->except($this->except());
    }

    protected function finishWrapper(array &$data): void
    {
        $data['config'] = $this->config;

        $data['attrs'] = $data['attributes'];
    }
}

<?php

namespace WireUi\Traits\Components;

trait HasSetupWrapper
{
    use HasSetupForm;

    protected function setupWrapper(array &$data): void
    {
        $data['wrapper'] = clone $this->attributes;
    }

    protected function finishWrapper(array &$data): void
    {
        $data['config'] = $this->config;

        $data['attrs'] = $data['attributes'];
    }
}

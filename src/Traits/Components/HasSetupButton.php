<?php

namespace WireUi\Traits\Components;

trait HasSetupButton
{
    public mixed $tag = null;

    protected function setupButton(): void
    {
        $this->tag = $this->getTag();

        $this->ensureLinkType();

        $this->ensureWireLoading();

        $this->setVariables(['tag']);
    }

    private function getTag(): string
    {
        return $this->attributes->missing('href') ? 'button' : 'a';
    }

    private function ensureLinkType(): void
    {
        if (! $this->attributes->has('href') && ! $this->attributes->has('type')) {
            $this->attributes->offsetSet('type', 'button');
        }
    }

    private function ensureWireLoading(): void
    {
        if (property_exists($this, 'wireLoadEnabled') && $this->wireLoadEnabled) {
            $this->attributes->offsetSet('wire:loading.attr', 'disabled');
            $this->attributes->offsetSet('wire:loading.class', '!cursor-wait');
        }
    }
}

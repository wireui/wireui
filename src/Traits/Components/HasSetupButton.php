<?php

namespace WireUi\Traits\Components;

trait HasSetupButton
{
    public mixed $tag = null;

    protected function setupButton(array &$component): void
    {
        $this->tag = $this->getTag();

        $this->ensureLinkType();

        $this->ensureWireLoading();

        $this->setVariables($component, ['tag']);
    }

    private function getTag(): string
    {
        return $this->data->missing('href') ? 'button' : 'a';
    }

    private function ensureLinkType(): void
    {
        if (!$this->data->has('href') && !$this->data->has('type')) {
            $this->data->offsetSet('type', 'button');
        }
    }

    private function ensureWireLoading(): void
    {
        if (property_exists($this, 'loading') && $this->loading) {
            $this->data->offsetSet('wire:loading.attr', 'disabled');
            $this->data->offsetSet('wire:loading.class', '!cursor-wait');
        }
    }
}

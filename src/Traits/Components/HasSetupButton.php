<?php

namespace WireUi\Traits\Components;

trait HasSetupButton
{
    protected function setupButton(array &$component): void
    {
        $this->tag = $this->getTag();

        $this->ensureLinkType();

        $this->ensureWireLoading();

        $this->setButtonVariables($component);

        $this->smart(['tag']);
    }

    private function setButtonVariables(array &$component): void
    {
        $component['tag'] = $this->tag;
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

<?php

namespace WireUi\Traits\Components;

trait HasSetupButton
{
    public mixed $tag = null;

    public bool $full = false;

    public mixed $label = null;

    public bool $loading = true;

    protected function setupButton(array &$component): void
    {
        $this->tag = $this->getTag();

        $this->label = $this->data->get('label');

        $this->loading = (bool) $this->data->get('loading');

        $this->full = (bool) ($this->data->get('full') ?? false);

        $this->ensureLinkType();

        $this->ensureWireLoading();

        $this->setButtonVariables($component);

        $this->smart(['tag', 'full', 'label', 'loading']);
    }

    private function getTag(): string
    {
        return $this->data->missing('href') ? 'button' : 'a';
    }

    private function ensureLinkType(): void
    {
        if (! $this->data->has('href') && ! $this->data->has('type')) {
            $this->data->offsetSet('type', 'button');
        }
    }

    private function ensureWireLoading(): void
    {
        if ($this->loading) {
            $this->data->offsetSet('wire:loading.attr', 'disabled');
            $this->data->offsetSet('wire:loading.class', '!cursor-wait');
        }
    }

    private function setButtonVariables(array &$component): void
    {
        $component['tag'] = $this->tag;

        $component['full'] = $this->full;

        $component['label'] = $this->label;

        $component['loading'] = $this->loading;
    }
}

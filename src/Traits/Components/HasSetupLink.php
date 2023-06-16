<?php

namespace WireUi\Traits\Components;

trait HasSetupLink
{
    public mixed $tag = null;

    public mixed $label = null;

    protected function setupLink(array &$component): void
    {
        $this->tag = $this->getTag();

        $this->label = $this->data->get('label');

        $this->ensureLinkType();

        $this->setLinkVariables($component);

        $this->smart('label');
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

    private function setLinkVariables(array &$component): void
    {
        $component['tag'] = $this->tag;

        $component['label'] = $this->label;
    }
}

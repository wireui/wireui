<?php

namespace WireUi\Traits\Components;

trait HasSetupCheckbox
{
    public mixed $label = null;

    public mixed $leftLabel = null;

    private mixed $description = null;

    protected function setupCheckbox(array &$component): void
    {
        $this->label = $this->data->get('label');

        $this->description = $this->data->get('description');

        $this->leftLabel = $this->data->get('left-label') ?? $this->data->get('leftLabel');

        $this->setCheckboxVariables($component);

        $this->smart(['label', 'leftLabel', 'description']);
    }

    private function setCheckboxVariables(array &$component): void
    {
        $component['label'] = $this->label;

        $component['leftLabel'] = $this->leftLabel;

        $component['description'] = $this->description;
    }
}

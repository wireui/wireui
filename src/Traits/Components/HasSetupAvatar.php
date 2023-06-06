<?php

namespace WireUi\Traits\Components;

trait HasSetupAvatar
{
    public mixed $src = null;

    public mixed $label = null;

    protected function setupAlert(array &$component): void
    {
        $this->src = $this->data->get('src');

        $this->label = $this->data->get('label');

        $this->setAlertVariables($component);

        $this->smart(['src', 'label']);
    }

    private function setAlertVariables(array &$component): void
    {
        $component['src'] = $this->src;

        $component['label'] = $this->label;
    }
}

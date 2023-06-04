<?php

namespace WireUi\Traits\Components;

trait HasSetupAlert
{
    public mixed $title = null;

    protected function setupAlert(array &$component): void
    {
        $this->title = $this->data->get('title');

        $this->setAlertVariables($component);

        $this->smart('title');
    }

    private function setAlertVariables(array &$component): void
    {
        $component['title'] = $this->title;
    }
}

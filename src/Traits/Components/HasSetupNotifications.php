<?php

namespace WireUi\Traits\Components;

trait HasSetupNotifications
{
    public mixed $zIndex = null;

    protected function setupNotification(array &$component): void
    {
        $this->zIndex = $this->getZIndex();

        $this->setNotificationVariables($component);

        $this->smart(['z-index', 'zIndex']);
    }

    private function getZIndex(): mixed
    {
        if ($this->data->has('z-index')) {
            return $this->data->get('z-index');
        }

        if ($this->data->has('zIndex')) {
            return $this->data->get('zIndex');
        }

        return config("wireui.{$this->config}.z-index");
    }

    private function setNotificationVariables(array &$component): void
    {
        $component['zIndex'] = $this->zIndex;
    }
}

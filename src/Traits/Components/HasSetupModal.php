<?php

namespace WireUi\Traits\Components;

trait HasSetupModal
{
    public mixed $name = null;

    private bool $show = false;

    public mixed $zIndex = null;

    public mixed $spacing = null;

    protected function setupModal(array &$component): void
    {
        $this->show = $this->getShow();

        $this->zIndex = $this->getZIndex();

        $this->spacing = $this->getSpacing();

        $this->name = $this->data->get('name');

        $this->setModalVariables($component);

        $this->smart(['name', 'show', 'spacing', 'z-index', 'zIndex']);
    }

    private function getShow(): bool
    {
        return $this->data->has('show') ? (bool) $this->data->get('show') : false;
    }

    private function getSpacing(): mixed
    {
        if ($this->data->has('spacing')) {
            return $this->data->get('spacing');
        }

        return config("wireui.{$this->config}.spacing");
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

    private function setModalVariables(array &$component): void
    {
        $component['name'] = $this->name;

        $component['show'] = $this->show;

        $component['zIndex'] = $this->zIndex;

        $component['spacing'] = $this->spacing;
    }
}

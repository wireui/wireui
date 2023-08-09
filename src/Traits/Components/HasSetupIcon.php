<?php

namespace WireUi\Traits\Components;

trait HasSetupIcon
{
    public mixed $icon = null;

    public bool $iconless = false;

    public mixed $rightIcon = null;

    protected function setupIcon(array &$component): void
    {
        $this->icon = $this->getIcon();

        $this->iconless = $this->getIconless();

        $this->rightIcon = $this->getRightIcon();

        $this->setIconVariables($component);

        $this->smart(['icon', 'iconless', 'right-icon', 'rightIcon']);
    }

    private function getIcon(): mixed
    {
        if ($this->data->has('icon')) {
            return $this->data->get('icon');
        }

        return config("wireui.{$this->config}.icon");
    }

    private function getIconless(): bool
    {
        if ($this->data->has('iconless')) {
            return (bool) $this->data->get('iconless');
        }

        return (bool) (config("wireui.{$this->config}.iconless") ?? false);
    }

    private function getRightIcon(): mixed
    {
        if ($this->data->has('right-icon')) {
            return $this->data->get('right-icon');
        }

        if ($this->data->has('rightIcon')) {
            return $this->data->get('rightIcon');
        }

        return config("wireui.{$this->config}.right-icon");
    }

    private function setIconVariables(array &$component): void
    {
        $component['icon'] = $this->icon;

        $component['iconless'] = $this->iconless;

        $component['rightIcon'] = $this->rightIcon;
    }
}

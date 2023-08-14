<?php

namespace WireUi\Traits\Components;

trait HasSetupIcon
{
    public mixed $icon = null;

    public bool $iconless = false;

    public mixed $rightIcon = null;

    protected function setupIcon(array &$component): void
    {
        $this->icon = $this->getData('icon');

        $this->rightIcon = $this->getData('right-icon');

        $this->iconless = (bool) ($this->getData('iconless') ?? false);

        $this->setIconVariables($component);
    }

    private function setIconVariables(array &$component): void
    {
        $component['icon'] = $this->icon;

        $component['iconless'] = $this->iconless;

        $component['rightIcon'] = $this->rightIcon;
    }
}

<?php

namespace WireUi\Traits\Components;

trait HasSetupIcon
{
    public mixed $icon = null;

    public bool $iconless = false;

    public mixed $rightIcon = null;

    protected function setupIcon(): void
    {
        $this->icon = $this->getData('icon');

        $this->rightIcon = $this->getData('right-icon');

        $this->iconless = (bool) ($this->getData('iconless') ?? false);

        $this->setVariables(['icon', 'iconless', 'rightIcon']);
    }
}

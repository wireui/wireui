<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupBorder
{
    public mixed $border = null;

    public bool $borderless = false;

    public mixed $borderClasses = null;

    protected function setupBorder(): void
    {
        /** @var ComponentPack $borderPack */
        $borderPack = resolve(config("wireui.{$this->config}.borders"));

        $this->border = $this->getData('border');

        $this->borderless = (bool) ($this->getData('borderless') ?? false);

        $this->borderClasses = $borderPack->get($this->border);

        $this->setVariables(['border', 'borderless', 'borderClasses']);
    }
}

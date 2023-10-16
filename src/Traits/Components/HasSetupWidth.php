<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupWidth
{
    public mixed $width = null;

    public mixed $widthClasses = null;

    protected function setupWidth(): void
    {
        /** @var ComponentPack $widthPack */
        $widthPack = resolve(config("wireui.{$this->config}.packs.widths"));

        $this->width = $this->getData('width');

        $this->widthClasses = $widthPack->get($this->width);

        $this->setVariables(['width', 'widthClasses']);
    }
}

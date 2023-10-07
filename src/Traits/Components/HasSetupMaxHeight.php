<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupMaxHeight
{
    public mixed $maxHeight = null;

    public mixed $maxHeightClasses = null;

    protected function setupMaxHeight(): void
    {
        /** @var ComponentPack $maxHeightPack */
        $maxHeightPack = resolve(config("wireui.{$this->config}.packs.max-heights"));

        $this->maxHeight = $this->getData('max-height');

        $this->maxHeightClasses = $maxHeightPack->get($this->maxHeight);

        $this->setVariables(['maxHeight', 'maxHeightClasses']);
    }
}

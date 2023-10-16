<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupHeight
{
    public mixed $height = null;

    public mixed $heightClasses = null;

    protected function setupHeight(): void
    {
        /** @var ComponentPack $heightPack */
        $heightPack = resolve(config("wireui.{$this->config}.packs.heights"));

        $this->height = $this->getData('height');

        $this->heightClasses = $heightPack->get($this->height);

        $this->setVariables(['height', 'heightClasses']);
    }
}

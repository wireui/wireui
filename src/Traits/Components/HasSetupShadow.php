<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupShadow
{
    public mixed $shadow = null;

    public bool $shadowless = false;

    public mixed $shadowClasses = null;

    protected function setupShadow(): void
    {
        /** @var ComponentPack $shadowPack */
        $shadowPack = resolve(config("wireui.{$this->config}.packs.shadows"));

        $this->shadow = $this->getData('shadow');

        $this->shadowless = (bool) ($this->getData('shadowless') ?? false);

        $this->shadowClasses = $shadowPack->get($this->shadow);

        $this->setVariables(['shadow', 'shadowless', 'shadowClasses']);
    }
}

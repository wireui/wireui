<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupAlign
{
    public mixed $align = null;

    public mixed $alignClasses = null;

    protected function setupAlign(): void
    {
        /** @var ComponentPack $alignPack */
        $alignPack = resolve(config("wireui.{$this->config}.packs.aligns"));

        $this->align = $this->getData('align');

        $this->alignClasses = $alignPack->get($this->align);

        $this->setVariables(['align', 'alignClasses']);
    }
}

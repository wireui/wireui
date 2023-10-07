<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupPadding
{
    public mixed $padding = null;

    public mixed $paddingClasses = null;

    protected function setupPadding(): void
    {
        /** @var ComponentPack $paddingPack */
        $paddingPack = resolve(config("wireui.{$this->config}.packs.paddings"));

        $this->padding = $this->getData('padding');

        $this->paddingClasses = $paddingPack->get($this->padding);

        $this->setVariables(['padding', 'paddingClasses']);
    }
}

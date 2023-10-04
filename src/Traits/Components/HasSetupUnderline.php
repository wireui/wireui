<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupUnderline
{
    public mixed $underline = null;

    public mixed $underlineClasses = null;

    protected function setupUnderline(): void
    {
        /** @var ComponentPack $underlinePack */
        $underlinePack = resolve(config("wireui.{$this->config}.underlines"));

        $this->underline = $this->getData('underline');

        $this->underlineClasses = $underlinePack->get($this->underline);

        $this->setVariables(['underline', 'underlineClasses']);
    }
}

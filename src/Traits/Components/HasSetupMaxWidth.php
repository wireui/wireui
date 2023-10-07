<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupMaxWidth
{
    public mixed $maxWidth = null;

    public mixed $maxWidthClasses = null;

    protected function setupMaxWidth(): void
    {
        /** @var ComponentPack $maxWidthPack */
        $maxWidthPack = resolve(config("wireui.{$this->config}.packs.max-widths"));

        $this->maxWidth = $this->getData('max-width');

        $this->maxWidthClasses = $maxWidthPack->get($this->maxWidth);

        $this->setVariables(['maxWidth', 'maxWidthClasses']);
    }
}

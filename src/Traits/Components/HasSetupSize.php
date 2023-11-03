<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupSize
{
    public mixed $size = null;

    public mixed $sizeClasses = null;

    protected function setupSize(): void
    {
        /** @var ComponentPack $sizePack */
        $sizePack = resolve(config("wireui.{$this->config}.packs.sizes"));

        $this->size = $this->getDataModifier('size', $sizePack);

        $this->sizeClasses = $sizePack->get($this->size);

        $this->setVariables(['size', 'sizeClasses']);
    }
}

<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupIconSize
{
    public mixed $iconSize = null;

    public mixed $iconSizeClasses = null;

    protected function setupIconSize(): void
    {
        /** @var ComponentPack $iconSizePack */
        $iconSizePack = resolve(config("wireui.{$this->config}.packs.icon-sizes"));

        $this->iconSize = $this->getData('icon-size', function ($config) {
            return (property_exists($this, 'size') && $this->size) ? $this->size : $config;
        });

        $this->iconSizeClasses = $iconSizePack->get($this->iconSize);

        $this->setVariables(['iconSize', 'iconSizeClasses']);
    }
}

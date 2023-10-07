<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupColor
{
    public mixed $color = null;

    public mixed $colorClasses = null;

    protected function setupColor(): void
    {
        /** @var ComponentPack $colorPack */
        $colorPack = resolve(config("wireui.{$this->config}.packs.colors"));

        $this->color = $this->getDataModifier('color', $colorPack);

        $this->colorClasses = $colorPack->get($this->color);

        if (method_exists($this, 'setColorPack')) {
            $this->setColorPack($colorPack);
        }

        $this->setVariables(['color', 'colorClasses']);
    }
}

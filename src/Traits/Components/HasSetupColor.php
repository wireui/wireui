<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupColor
{
    public mixed $color = null;

    public mixed $colorClasses = null;

    private mixed $colorResolve = null;

    protected function setColorResolve(string $class): void
    {
        $this->colorResolve = $class;
    }

    protected function setupColor(): void
    {
        $colors = config("wireui.{$this->config}.packs.colors");

        /** @var ComponentPack $colorPack */
        $colorPack = $colors ? resolve($colors) : resolve($this->colorResolve);

        $this->color = $this->getDataModifier('color', $colorPack);

        $this->colorClasses = $colorPack->get($this->color);

        if (method_exists($this, 'setColorPack')) {
            $this->setColorPack($colorPack);
        }

        $this->setVariables(['color', 'colorClasses']);
    }
}

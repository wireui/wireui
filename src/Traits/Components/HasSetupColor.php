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
        $colorPack = resolve(config($this->getColorConfigName()));

        $this->color = $this->getDataModifier('color', $colorPack);

        $this->colorClasses = $colorPack->get($this->color);

        if (method_exists($this, 'setColorPack')) {
            $this->setColorPack($colorPack);
        }

        $this->setVariables(['color', 'colorClasses']);
    }

    private function getColorConfigName(string $variant = null): string
    {
        if ($variant) {
            return "wireui.{$this->config}.colors.{$variant}";
        }

        if (property_exists($this, 'variant')) {
            return "wireui.{$this->config}.colors.{$this->variant}";
        }

        return "wireui.{$this->config}.colors";
    }
}

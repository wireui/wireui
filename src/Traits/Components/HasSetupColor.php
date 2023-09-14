<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
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

    protected function setupColor(array &$data): void
    {
        throw_if(!$this->colorResolve, new WireUiResolveException($this));

        $colors = config($this->getColorConfigName());

        /** @var ComponentPack $colorPack */
        $colorPack = $colors ? resolve($colors) : resolve($this->colorResolve);

        $this->color = $this->getDataModifier('color', $colorPack);

        $this->colorClasses = $colorPack->get($this->color);

        if (method_exists($this, 'setColorPack')) {
            $this->setColorPack($colorPack);
        }

        $this->setVariables($data, ['color', 'colorClasses']);
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

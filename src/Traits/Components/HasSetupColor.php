<?php

namespace WireUi\Traits\Components;

use Exception;

trait HasSetupColor
{
    public mixed $color = null;

    public mixed $colorClasses = null;

    protected mixed $colorResolve = null;

    protected function setColorResolve(string $class): void
    {
        $this->colorResolve = $class;
    }

    protected function setupColor(array &$component): void
    {
        throw_if(!$this->colorResolve, new Exception('You must define a color resolve.'));

        $colors = config($this->getColorConfigName());

        [$this->color, $colorPack] = $this->getDataModifier($colors, 'color');

        $this->colorClasses = $colorPack->get($this->color);

        if (method_exists($this, 'setColorPack')) {
            $this->setColorPack($colorPack);
        }

        $this->setColorVariables($component);
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

    private function setColorVariables(array &$component): void
    {
        $component['color'] = $this->color;

        $component['colorClasses'] = $this->colorClasses;
    }
}

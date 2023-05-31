<?php

namespace WireUi\View\Setup;

use WireUi\Support\ComponentPack;

trait HasSetupColor
{
    public mixed $color = null;

    public mixed $colorClasses = null;

    /**
     * Setup the color.
     */
    protected function setupColor(array &$component): void
    {
        $colors = config("wireui.{$this->config}.colors");

        if (is_null($colors)) {
            return;
        }

        /** @var ComponentPack $colorPack */
        $colorPack = resolve($colors);

        $this->color = $this->data->get('color') ?? $this->getMatchModifier($colorPack->keys());

        $this->color ??= config("wireui.{$this->config}.color");

        $this->colorClasses = $colorPack->get($this->color);

        $this->setColorVariables($component);

        // $this->custom('color', $colorPack->get($this->color));

        // $this->color = $colorPack->get($this->color);

        // $component['color'] = $colorPack->get($this->color);

        $this->smart([$this->color, 'color']);
    }

    private function setColorVariables(array &$component): void
    {
        $component['color'] = $this->color;

        $component['colorClasses'] = $this->colorClasses;
    }
}

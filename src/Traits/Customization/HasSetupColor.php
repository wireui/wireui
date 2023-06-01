<?php

namespace WireUi\Traits\Customization;

use Exception;
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

    protected function setupColor(array &$component): void
    {
        throw_if(!$this->colorResolve, new Exception('You must define a color resolve.'));

        $colors = config("wireui.{$this->config}.colors");

        /** @var ComponentPack $colorPack */
        $colorPack = $colors ? resolve($colors) : resolve_wireui($this->colorResolve);

        $this->color = $this->data->get('color') ?? $this->getMatchModifier($colorPack->keys());

        $this->color ??= config("wireui.{$this->config}.color");

        $this->getColorClasses($colorPack);

        $this->setColorVariables($component);

        $this->smart([$this->color, 'color']);
    }

    private function getColorClasses(mixed $colorPack): void
    {
        $this->colorClasses = $colorPack->get($this->color);

        $this->colorClasses = check_result($this->colorClasses);
    }

    private function setColorVariables(array &$component): void
    {
        $component['color'] = $this->color;

        $component['colorClasses'] = $this->colorClasses;
    }
}

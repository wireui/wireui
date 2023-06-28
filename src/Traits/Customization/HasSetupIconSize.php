<?php

namespace WireUi\Traits\Customization;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupIconSize
{
    public mixed $iconSize = null;

    public mixed $iconSizeClasses = null;

    private mixed $iconSizeResolve = null;

    protected function setIconSizeResolve(string $class): void
    {
        $this->iconSizeResolve = $class;
    }

    protected function setupIconSize(array &$component): void
    {
        throw_if(!$this->iconSizeResolve, new Exception('You must define a icon size resolve.'));

        $icons = config("wireui.{$this->config}.icon-sizes");

        /** @var ComponentPack $iconPack */
        $iconPack = $icons ? resolve($icons) : resolve($this->iconSizeResolve);

        $this->iconSize = $this->getIconSize();

        $this->iconSizeClasses = $iconPack->get($this->iconSize);

        $this->setIconSizeVariables($component);

        $this->smart(['icon-size', 'iconSize']);
    }

    private function getIconSize(): mixed
    {
        if ($this->data->has('icon-size')) {
            return $this->data->get('icon-size');
        }

        if ($this->data->has('iconSize')) {
            return $this->data->get('iconSize');
        }

        if (property_exists($this, 'size')) {
            return $this->size;
        }

        return config("wireui.{$this->config}.icon-size");
    }

    private function setIconSizeVariables(array &$component): void
    {
        $component['iconSize'] = $this->iconSize;

        $component['iconSizeClasses'] = $this->iconSizeClasses;
    }
}

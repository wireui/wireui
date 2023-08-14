<?php

namespace WireUi\Traits\Components;

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

        $this->iconSize = $this->getData('icon-size',
            fn ($config) => property_exists($this, 'size') && $this->size ? $this->size : $config,
        );

        $this->iconSizeClasses = $iconPack->get($this->iconSize);

        $this->setIconSizeVariables($component);
    }

    private function setIconSizeVariables(array &$component): void
    {
        $component['iconSize'] = $this->iconSize;

        $component['iconSizeClasses'] = $this->iconSizeClasses;
    }
}

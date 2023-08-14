<?php

namespace WireUi\Traits\Components;

use Exception;

trait HasSetupIconSize
{
    public mixed $iconSize = null;

    public mixed $iconSizeClasses = null;

    protected mixed $iconSizeResolve = null;

    protected function setIconSizeResolve(string $class): void
    {
        $this->iconSizeResolve = $class;
    }

    protected function setupIconSize(array &$component): void
    {
        throw_if(!$this->iconSizeResolve, new Exception('You must define a icon size resolve.'));

        $iconSizes = config("wireui.{$this->config}.icon-sizes");

        $iconSizePack = $this->getResolve($iconSizes, 'iconSize');

        $this->iconSize = $this->getData('icon-size',
            fn ($config) => property_exists($this, 'size') && $this->size ? $this->size : $config,
        );

        $this->iconSizeClasses = $iconSizePack->get($this->iconSize);

        $this->setIconSizeVariables($component);
    }

    private function setIconSizeVariables(array &$component): void
    {
        $component['iconSize'] = $this->iconSize;

        $component['iconSizeClasses'] = $this->iconSizeClasses;
    }
}

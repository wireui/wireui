<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
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
        throw_if(!$this->iconSizeResolve, new WireUiResolveException($this));

        $iconSizes = config("wireui.{$this->config}.icon-sizes");

        /** @var ComponentPack $iconSizePack */
        $iconSizePack = $iconSizes ? resolve($iconSizes) : resolve($this->iconSizeResolve);

        $this->iconSize = $this->getData('icon-size',
            fn ($config) => (property_exists($this, 'size') && $this->size) ? $this->size : $config,
        );

        $this->iconSizeClasses = $iconSizePack->get($this->iconSize);

        $this->setVariables($component, ['iconSize', 'iconSizeClasses']);
    }
}

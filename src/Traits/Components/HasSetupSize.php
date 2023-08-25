<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupSize
{
    public mixed $size = null;

    public mixed $sizeClasses = null;

    private mixed $sizeResolve = null;

    protected function setSizeResolve(string $class): void
    {
        $this->sizeResolve = $class;
    }

    protected function setupSize(array &$component): void
    {
        throw_if(!$this->sizeResolve, new WireUiResolveException($this));

        $sizes = config("wireui.{$this->config}.sizes");

        /** @var ComponentPack $sizePack */
        $sizePack = $sizes ? resolve($sizes) : resolve($this->sizeResolve);

        $this->size = $this->getDataModifier('size', $sizePack);

        $this->sizeClasses = $sizePack->get($this->size);

        $this->setVariables($component, ['size', 'sizeClasses']);
    }
}

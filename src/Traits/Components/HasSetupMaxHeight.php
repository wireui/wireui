<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupMaxHeight
{
    public mixed $maxHeight = null;

    public mixed $maxHeightClasses = null;

    private mixed $maxHeightResolve = null;

    protected function setMaxHeightResolve(string $class): void
    {
        $this->maxHeightResolve = $class;
    }

    protected function setupMaxHeight(): void
    {
        throw_if(!$this->maxHeightResolve, new WireUiResolveException($this));

        $maxHeights = config("wireui.{$this->config}.max-heights");

        /** @var ComponentPack $maxHeightPack */
        $maxHeightPack = $maxHeights ? resolve($maxHeights) : resolve($this->maxHeightResolve);

        $this->maxHeight = $this->getData('max-height');

        $this->maxHeightClasses = $maxHeightPack->get($this->maxHeight);

        $this->setVariables(['maxHeight', 'maxHeightClasses']);
    }
}

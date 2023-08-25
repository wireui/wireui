<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupPosition
{
    public mixed $position = null;

    public mixed $positionClasses = null;

    private mixed $positionResolve = null;

    protected function setPositionResolve(string $class): void
    {
        $this->positionResolve = $class;
    }

    protected function setupPosition(array &$component): void
    {
        throw_if(!$this->positionResolve, new WireUiResolveException($this));

        $positions = config("wireui.{$this->config}.positions");

        /** @var ComponentPack $positionPack */
        $positionPack = $positions ? resolve($positions) : resolve($this->positionResolve);

        $this->position = $this->getData('position');

        $this->positionClasses = $positionPack->get($this->position);

        $this->setVariables($component, ['position', 'positionClasses']);
    }
}

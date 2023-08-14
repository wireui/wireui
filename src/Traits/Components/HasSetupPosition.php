<?php

namespace WireUi\Traits\Components;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupPosition
{
    public mixed $position = null;

    public mixed $positionClasses = null;

    protected mixed $positionResolve = null;

    protected function setPositionResolve(string $class): void
    {
        $this->positionResolve = $class;
    }

    protected function setupPosition(array &$component): void
    {
        throw_if(!$this->positionResolve, new Exception('You must define a position resolve.'));

        $positions = config("wireui.{$this->config}.positions");

        /** @var ComponentPack $positionPack */
        $positionPack = $positions ? resolve($positions) : resolve($this->positionResolve);

        $this->position = $this->getData('position');

        $this->positionClasses = $positionPack->get($this->position);

        $this->setPositionVariables($component);
    }

    private function setPositionVariables(array &$component): void
    {
        $component['position'] = $this->position;

        $component['positionClasses'] = $this->positionClasses;
    }
}

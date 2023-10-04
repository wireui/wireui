<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupPosition
{
    public mixed $position = null;

    public mixed $positionClasses = null;

    protected function setupPosition(): void
    {
        /** @var ComponentPack $positionPack */
        $positionPack = resolve(config("wireui.{$this->config}.positions"));

        $this->position = $this->getData('position');

        $this->positionClasses = $positionPack->get($this->position);

        $this->setVariables(['position', 'positionClasses']);
    }
}

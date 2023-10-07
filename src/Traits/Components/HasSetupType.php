<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupType
{
    public mixed $type = null;

    public mixed $typeClasses = null;

    protected function setupType(): void
    {
        /** @var ComponentPack $typePack */
        $typePack = resolve(config("wireui.{$this->config}.packs.types"));

        $this->type = $this->getData('type');

        $this->typeClasses = $typePack->get($this->type);

        $this->setVariables(['type', 'typeClasses']);
    }
}

<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupType
{
    public mixed $type = null;

    public mixed $typeClasses = null;

    private mixed $typeResolve = null;

    protected function setTypeResolve(string $class): void
    {
        $this->typeResolve = $class;
    }

    protected function setupType(array &$data): void
    {
        throw_if(!$this->typeResolve, new WireUiResolveException($this));

        $types = config("wireui.{$this->config}.types");

        /** @var ComponentPack $typePack */
        $typePack = $types ? resolve($types) : resolve($this->typeResolve);

        $this->type = $this->getData('type');

        $this->typeClasses = $typePack->get($this->type);

        $this->setVariables($data, ['type', 'typeClasses']);
    }
}

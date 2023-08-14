<?php

namespace WireUi\Traits\Components;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupType
{
    public mixed $type = null;

    public mixed $typeClasses = null;

    protected mixed $typeResolve = null;

    protected function setTypeResolve(string $class): void
    {
        $this->typeResolve = $class;
    }

    protected function setupType(array &$component): void
    {
        throw_if(!$this->typeResolve, new Exception('You must define a type resolve.'));

        $types = config("wireui.{$this->config}.types");

        /** @var ComponentPack $typePack */
        $typePack = $types ? resolve($types) : resolve($this->typeResolve);

        $this->type = $this->getData('type');

        $this->typeClasses = $typePack->get($this->type);

        $this->setTypeVariables($component);
    }

    private function setTypeVariables(array &$component): void
    {
        $component['type'] = $this->type;

        $component['typeClasses'] = $this->typeClasses;
    }
}

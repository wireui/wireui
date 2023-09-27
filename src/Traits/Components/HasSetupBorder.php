<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupBorder
{
    public mixed $border = null;

    public bool $borderless = false;

    public mixed $borderClasses = null;

    private mixed $borderResolve = null;

    protected function setBorderResolve(string $class): void
    {
        $this->borderResolve = $class;
    }

    protected function setupBorder(array &$data): void
    {
        throw_if(!$this->borderResolve, new WireUiResolveException($this));

        $borders = config("wireui.{$this->config}.borders");

        /** @var ComponentPack $borderPack */
        $borderPack = $borders ? resolve($borders) : resolve($this->borderResolve);

        $this->border = $this->getData('border');

        $this->borderless = (bool) ($this->getData('borderless') ?? false);

        $this->borderClasses = $borderPack->get($this->border);

        $this->setVariables($data, ['border', 'borderless', 'borderClasses']);
    }
}

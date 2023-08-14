<?php

namespace WireUi\Traits\Components;

use Exception;

trait HasSetupBorder
{
    public mixed $border = null;

    public bool $borderless = false;

    public mixed $borderClasses = null;

    protected mixed $borderResolve = null;

    protected function setBorderResolve(string $class): void
    {
        $this->borderResolve = $class;
    }

    protected function setupBorder(array &$component): void
    {
        throw_if(!$this->borderResolve, new Exception('You must define a border resolve.'));

        $borders = config("wireui.{$this->config}.borders");

        $borderPack = $this->getResolve($borders, 'border');

        $this->border = $this->getData('border');

        $this->borderless = (bool) ($this->getData('borderless') ?? false);

        $this->borderClasses = $borderPack->get($this->border);

        $this->setBorderVariables($component);
    }

    private function setBorderVariables(array &$component): void
    {
        $component['border'] = $this->border;

        $component['borderless'] = $this->borderless;

        $component['borderClasses'] = $this->borderClasses;
    }
}

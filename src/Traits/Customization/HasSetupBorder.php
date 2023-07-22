<?php

namespace WireUi\Traits\Customization;

use Exception;
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

    protected function setupBorder(array &$component): void
    {
        throw_if(! $this->borderResolve, new Exception('You must define a border resolve.'));

        $borders = config("wireui.{$this->config}.borders");

        /** @var ComponentPack $borderPack */
        $borderPack = $borders ? resolve($borders) : resolve($this->borderResolve);

        $this->borderless = $this->getBorderless();

        $this->border = $this->data->get('border') ?? config("wireui.{$this->config}.border");

        $this->borderClasses = $borderPack->get($this->border);

        $this->setBorderVariables($component);

        $this->smart(['border', 'borderless']);
    }

    private function getBorderless(): bool
    {
        if ($this->data->has('borderless')) {
            return (bool) $this->data->get('borderless');
        }

        return (bool) (config("wireui.{$this->config}.borderless") ?? false);
    }

    private function setBorderVariables(array &$component): void
    {
        $component['border'] = $this->border;

        $component['borderless'] = $this->borderless;

        $component['borderClasses'] = $this->borderClasses;
    }
}

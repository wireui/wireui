<?php

namespace WireUi\Traits\Components;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupRounded
{
    public mixed $squared = null;

    public mixed $rounded = null;

    public mixed $roundedClasses = null;

    private mixed $roundedResolve = null;

    protected function setRoundedResolve(string $class): void
    {
        $this->roundedResolve = $class;
    }

    protected function setupRounded(array &$component): void
    {
        throw_if(!$this->roundedResolve, new Exception('You must define a rounded resolve.'));

        $rounders = config("wireui.{$this->config}.rounders");

        /** @var ComponentPack $roundedPack */
        $roundedPack = $rounders ? resolve($rounders) : resolve($this->roundedResolve);

        $this->squared = $this->getData('squared');

        $this->rounded = $this->getData('rounded');

        $this->getRoundedClasses($roundedPack);

        $this->setRoundedVariables($component);
    }

    private function getRoundedClasses(mixed $roundedPack): void
    {
        if ($this->squared) {
            $this->roundedClasses = $roundedPack->get('none');
        } elseif (!$this->squared && $this->rounded && is_bool($this->rounded)) {
            $this->roundedClasses = $roundedPack->get('full');
        } elseif (!$this->squared) {
            $this->roundedClasses = $roundedPack->get($this->rounded);
        }
    }

    private function setRoundedVariables(array &$component): void
    {
        $component['squared'] = $this->squared;

        $component['rounded'] = $this->rounded;

        $component['roundedClasses'] = $this->roundedClasses;
    }
}

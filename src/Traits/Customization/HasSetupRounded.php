<?php

namespace WireUi\Traits\Customization;

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
        $roundedPack = $rounders ? resolve($rounders) : resolve_wireui($this->roundedResolve);

        $this->squared = $this->data->get('squared');

        $this->rounded = $this->data->get('rounded') ?? config("wireui.{$this->config}.rounded");

        $this->getRoundedClasses($roundedPack);

        $this->setRoundedVariables($component);

        $this->smart(['rounded', 'squared']);
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

        $this->roundedClasses = check_result($this->roundedClasses);
    }

    private function setRoundedVariables(array &$component): void
    {
        $component['squared'] = $this->squared;

        $component['rounded'] = $this->rounded;

        $component['roundedClasses'] = $this->roundedClasses;
    }
}

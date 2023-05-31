<?php

namespace WireUi\View\Setup;

use WireUi\Support\ComponentPack;

trait HasSetupRounded
{
    public mixed $squared = null;

    public mixed $rounded = null;

    public mixed $roundedClasses = null;

    /**
     * Setup the rounded.
     */
    protected function setupRounded(array &$component): void
    {
        $rounders = config("wireui.{$this->config}.rounders");

        if (is_null($rounders)) {
            return;
        }

        /** @var ComponentPack $roundedPack */
        $roundedPack = resolve($rounders);

        $this->squared = $this->data->get('squared');

        $this->rounded = $this->data->get('rounded') ?? config("wireui.{$this->config}.rounded");

        if ($this->squared) {
            $this->roundedClasses = $roundedPack->get('none');
        } elseif (!$this->squared && $this->rounded && is_bool($this->rounded)) {
            $this->roundedClasses = $roundedPack->get('full');
        } elseif (!$this->squared) {
            $this->roundedClasses = $roundedPack->get($this->rounded);
        }

        $this->setRoundedVariables($component);

        $this->smart(['rounded', 'squared']);
    }

    private function setRoundedVariables(array &$component): void
    {
        $component['squared'] = $this->squared;

        $component['rounded'] = $this->rounded;

        $component['roundedClasses'] = $this->roundedClasses;
    }
}

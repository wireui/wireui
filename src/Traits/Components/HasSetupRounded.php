<?php

namespace WireUi\Traits\Components;

use Exception;

trait HasSetupRounded
{
    public mixed $squared = null;

    public mixed $rounded = null;

    public mixed $roundedClasses = null;

    protected mixed $roundedResolve = null;

    protected function setRoundedResolve(string $class): void
    {
        $this->roundedResolve = $class;
    }

    protected function setupRounded(array &$component): void
    {
        throw_if(!$this->roundedResolve, new Exception('You must define a rounded resolve.'));

        $rounders = config("wireui.{$this->config}.rounders");

        $roundedPack = $this->getResolve($rounders, 'rounded');

        $this->squared = $this->getData('squared');

        $this->rounded = $this->getData('rounded');

        $this->getRoundedClasses($roundedPack);

        $this->setRoundedVariables($component);
    }

    /**
     * Fix this function when squared is true in config.
     */
    private function getRoundedClasses(mixed $roundedPack): void
    {
        $fullRounded = $this->rounded && is_bool($this->rounded);

        $this->roundedClasses = match (true) {
            $this->squared => $roundedPack->get('none'),
            $fullRounded   => $roundedPack->get('full'),
            default        => $roundedPack->get($this->rounded),
        };
    }

    private function setRoundedVariables(array &$component): void
    {
        $component['squared'] = $this->squared;

        $component['rounded'] = $this->rounded;

        $component['roundedClasses'] = $this->roundedClasses;
    }
}

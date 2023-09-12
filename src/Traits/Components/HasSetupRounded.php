<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
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
        throw_if(!$this->roundedResolve, new WireUiResolveException($this));

        $rounders = config("wireui.{$this->config}.rounders");

        /** @var ComponentPack $roundedPack */
        $roundedPack = $rounders ? resolve($rounders) : resolve($this->roundedResolve);

        $this->squared = $this->data->get('squared');

        $this->rounded = $this->data->get('rounded');

        $this->getRoundedClasses($roundedPack);

        $this->setVariables($component, ['squared', 'rounded', 'roundedClasses']);
    }

    private function getRoundedClasses(mixed $roundedPack): void
    {
        $config = config("wireui.{$this->config}.rounded");

        $fullRounded = $this->rounded && is_bool($this->rounded);

        $this->roundedClasses = match (true) {
            (bool) $this->squared => $roundedPack->get('none'),
            (bool) $fullRounded   => $roundedPack->get('full'),
            (bool) $this->rounded => $roundedPack->get($this->rounded),
            default               => $roundedPack->get($config),
        };
    }
}

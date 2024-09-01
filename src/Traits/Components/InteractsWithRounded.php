<?php

namespace WireUi\Traits\Components;

use WireUi\Attributes\Mount;
use WireUi\Support\ComponentPack;

trait InteractsWithRounded
{
    public mixed $squared = null;

    public mixed $rounded = null;

    public mixed $roundedClasses = null;

    private mixed $roundedResolve = null;

    protected function setRoundedResolve(string $class): void
    {
        $this->roundedResolve = $class;
    }

    #[Mount(70)]
    protected function mountRounded(): void
    {
        $rounders = config("wireui.{$this->config}.packs.rounders");

        /** @var ComponentPack $roundedPack */
        $roundedPack = resolve($rounders ?? $this->roundedResolve);

        $this->squared = $this->attributes->get('squared', false);

        $this->rounded = $this->attributes->get('rounded', false);

        $this->getRoundedClasses($roundedPack);

        $this->smartAttributes(['squared', 'rounded']);

        $this->setVariables(['squared', 'rounded', 'roundedClasses']);
    }

    private function getRoundedClasses(mixed $roundedPack): void
    {
        $config = config("wireui.{$this->config}.default.rounded");

        $fullRounded = $this->rounded && is_bool($this->rounded);

        $this->roundedClasses = match (true) {
            (bool) $this->squared => $roundedPack->get('none'),
            (bool) $fullRounded => $roundedPack->get('full'),
            (bool) $this->rounded => $roundedPack->get($this->rounded),
            default => $roundedPack->get($config),
        };
    }
}

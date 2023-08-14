<?php

namespace WireUi\Traits\Components;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupShadow
{
    public mixed $shadow = null;

    public bool $shadowless = false;

    public mixed $shadowClasses = null;

    private mixed $shadowResolve = null;

    protected function setShadowResolve(string $class): void
    {
        $this->shadowResolve = $class;
    }

    protected function setupShadow(array &$component): void
    {
        throw_if(!$this->shadowResolve, new Exception('You must define a shadow resolve.'));

        $shadows = config("wireui.{$this->config}.shadows");

        /** @var ComponentPack $shadowPack */
        $shadowPack = $shadows ? resolve($shadows) : resolve($this->shadowResolve);

        $this->shadow = $this->getData('shadow');

        $this->shadowless = (bool) ($this->getData('shadowless') ?? false);

        $this->shadowClasses = $shadowPack->get($this->shadow);

        $this->setShadowVariables($component);
    }

    private function setShadowVariables(array &$component): void
    {
        $component['shadow'] = $this->shadow;

        $component['shadowless'] = $this->shadowless;

        $component['shadowClasses'] = $this->shadowClasses;
    }
}

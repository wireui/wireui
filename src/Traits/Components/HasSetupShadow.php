<?php

namespace WireUi\Traits\Components;

use Exception;

trait HasSetupShadow
{
    public mixed $shadow = null;

    public bool $shadowless = false;

    public mixed $shadowClasses = null;

    protected mixed $shadowResolve = null;

    protected function setShadowResolve(string $class): void
    {
        $this->shadowResolve = $class;
    }

    protected function setupShadow(array &$component): void
    {
        throw_if(!$this->shadowResolve, new Exception('You must define a shadow resolve.'));

        $shadows = config("wireui.{$this->config}.shadows");

        $shadowPack = $this->getResolve($shadows, 'shadow');

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

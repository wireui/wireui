<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

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
        throw_if(!$this->shadowResolve, new WireUiResolveException($this));

        $shadows = config("wireui.{$this->config}.shadows");

        /** @var ComponentPack $shadowPack */
        $shadowPack = $shadows ? resolve($shadows) : resolve($this->shadowResolve);

        $this->shadow = $this->getData('shadow');

        $this->shadowless = (bool) ($this->getData('shadowless') ?? false);

        $this->shadowClasses = $shadowPack->get($this->shadow);

        $this->setVariables($component, ['shadow', 'shadowless', 'shadowClasses']);
    }
}

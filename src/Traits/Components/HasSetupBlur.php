<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupBlur
{
    public mixed $blur = null;

    public bool $blurless = false;

    public mixed $blurClasses = null;

    private mixed $blurResolve = null;

    protected function setBlurResolve(string $class): void
    {
        $this->blurResolve = $class;
    }

    protected function setupBlur(array &$component): void
    {
        throw_if(!$this->blurResolve, new WireUiResolveException($this));

        $blurs = config("wireui.{$this->config}.blurs");

        /** @var ComponentPack $blurPack */
        $blurPack = $blurs ? resolve($blurs) : resolve($this->blurResolve);

        $this->blur = $this->getData('blur');

        $this->blurless = (bool) ($this->getData('blurless') ?? false);

        $this->blurClasses = $blurPack->get($this->blur);

        $this->setVariables($component, ['blur', 'blurless', 'blurClasses']);
    }
}

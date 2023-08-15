<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupUnderline
{
    public mixed $underline = null;

    public mixed $underlineClasses = null;

    protected mixed $underlineResolve = null;

    protected function setUnderlineResolve(string $class): void
    {
        $this->underlineResolve = $class;
    }

    protected function setupUnderline(array &$component): void
    {
        throw_if(!$this->underlineResolve, new WireUiResolveException($this));

        $underlines = config("wireui.{$this->config}.underlines");

        /** @var ComponentPack $underlinePack */
        $underlinePack = $underlines ? resolve($underlines) : resolve($this->underlineResolve);

        $this->underline = $this->getData('underline');

        $this->underlineClasses = $underlinePack->get($this->underline);

        $this->setVariables($component, ['underline', 'underlineClasses']);
    }
}

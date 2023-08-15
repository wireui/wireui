<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupAlign
{
    public mixed $align = null;

    public mixed $alignClasses = null;

    protected mixed $alignResolve = null;

    protected function setAlignResolve(string $class): void
    {
        $this->alignResolve = $class;
    }

    protected function setupAlign(array &$component): void
    {
        throw_if(!$this->alignResolve, new WireUiResolveException($this));

        $aligns = config("wireui.{$this->config}.aligns");

        /** @var ComponentPack $alignPack */
        $alignPack = $aligns ? resolve($aligns) : resolve($this->alignResolve);

        $this->align = $this->getData('align');

        $this->alignClasses = $alignPack->get($this->align);

        $this->setVariables($component, ['align', 'alignClasses']);
    }
}

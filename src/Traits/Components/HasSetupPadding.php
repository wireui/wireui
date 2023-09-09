<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupPadding
{
    public mixed $padding = null;

    public mixed $paddingClasses = null;

    private mixed $paddingResolve = null;

    protected function setPaddingResolve(string $class): void
    {
        $this->paddingResolve = $class;
    }

    protected function setupPadding(array &$component): void
    {
        throw_if(!$this->paddingResolve, new WireUiResolveException($this));

        $paddings = config("wireui.{$this->config}.paddings");

        /** @var ComponentPack $paddingPack */
        $paddingPack = $paddings ? resolve($paddings) : resolve($this->paddingResolve);

        $this->padding = $this->getData('padding');

        $this->paddingClasses = $paddingPack->get($this->padding);

        $this->setVariables($component, ['padding', 'paddingClasses']);
    }
}

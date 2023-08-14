<?php

namespace WireUi\Traits\Components;

use Exception;

trait HasSetupPadding
{
    public mixed $padding = null;

    public mixed $paddingClasses = null;

    protected mixed $paddingResolve = null;

    protected function setPaddingResolve(string $class): void
    {
        $this->paddingResolve = $class;
    }

    protected function setupPadding(array &$component): void
    {
        throw_if(!$this->paddingResolve, new Exception('You must define a padding resolve.'));

        $paddings = config("wireui.{$this->config}.paddings");

        $paddingPack = $this->getResolve($paddings, 'padding');

        $this->padding = $this->getData('padding');

        $this->paddingClasses = $paddingPack->get($this->padding);

        $this->setPaddingVariables($component);
    }

    private function setPaddingVariables(array &$component): void
    {
        $component['padding'] = $this->padding;

        $component['paddingClasses'] = $this->paddingClasses;
    }
}

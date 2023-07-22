<?php

namespace WireUi\Traits\Customization;

use Exception;
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
        throw_if(! $this->paddingResolve, new Exception('You must define a padding resolve.'));

        $paddings = config("wireui.{$this->config}.paddings");

        /** @var ComponentPack $paddingPack */
        $paddingPack = $paddings ? resolve($paddings) : resolve($this->paddingResolve);

        $this->padding = $this->data->get('padding') ?? config("wireui.{$this->config}.padding");

        $this->paddingClasses = $paddingPack->get($this->padding);

        $this->setPaddingVariables($component);

        $this->smart('padding');
    }

    private function setPaddingVariables(array &$component): void
    {
        $component['padding'] = $this->padding;

        $component['paddingClasses'] = $this->paddingClasses;
    }
}

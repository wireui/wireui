<?php

namespace WireUi\Traits\Customization;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupUnderline
{
    public mixed $underline = null;

    public mixed $underlineClasses = null;

    private mixed $underlineResolve = null;

    protected function setUnderlineResolve(string $class): void
    {
        $this->underlineResolve = $class;
    }

    protected function setupUnderline(array &$component): void
    {
        throw_if(! $this->underlineResolve, new Exception('You must define a underline resolve.'));

        $underlines = config("wireui.{$this->config}.underlines");

        /** @var ComponentPack $underlinePack */
        $underlinePack = $underlines ? resolve($underlines) : resolve($this->underlineResolve);

        $this->underline = $this->data->get('underline') ?? config("wireui.{$this->config}.underline");

        $this->underlineClasses = $underlinePack->get($this->underline);

        $this->setUnderlineVariables($component);

        $this->smart('underline');
    }

    private function setUnderlineVariables(array &$component): void
    {
        $component['underline'] = $this->underline;

        $component['underlineClasses'] = $this->underlineClasses;
    }
}

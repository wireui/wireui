<?php

namespace WireUi\Traits\Components;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupAlign
{
    public mixed $align = null;

    public mixed $alignClasses = null;

    private mixed $alignResolve = null;

    protected function setAlignResolve(string $class): void
    {
        $this->alignResolve = $class;
    }

    protected function setupAlign(array &$component): void
    {
        throw_if(!$this->alignResolve, new Exception('You must define a align resolve.'));

        $aligns = config("wireui.{$this->config}.aligns");

        /** @var ComponentPack $alignPack */
        $alignPack = $aligns ? resolve($aligns) : resolve($this->alignResolve);

        $this->align = $this->data->get('align') ?? config("wireui.{$this->config}.align");

        $this->alignClasses = $alignPack->get($this->align);

        $this->setAlignVariables($component);

        $this->smart('align');
    }

    private function setAlignVariables(array &$component): void
    {
        $component['align'] = $this->align;

        $component['alignClasses'] = $this->alignClasses;
    }
}

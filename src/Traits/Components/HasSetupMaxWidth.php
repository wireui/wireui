<?php

namespace WireUi\Traits\Components;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupMaxWidth
{
    public mixed $maxWidth = null;

    public mixed $maxWidthClasses = null;

    protected mixed $maxWidthResolve = null;

    protected function setMaxWidthResolve(string $class): void
    {
        $this->maxWidthResolve = $class;
    }

    protected function setupMaxWidth(array &$component): void
    {
        throw_if(!$this->maxWidthResolve, new Exception('You must define a max-width resolve.'));

        $maxWidths = config("wireui.{$this->config}.max-widths");

        /** @var ComponentPack $maxWidthPack */
        $maxWidthPack = $maxWidths ? resolve($maxWidths) : resolve($this->maxWidthResolve);

        $this->maxWidth = $this->getData('max-width');

        $this->maxWidthClasses = $maxWidthPack->get($this->maxWidth);

        $this->setMaxWidthVariables($component);
    }

    private function setMaxWidthVariables(array &$component): void
    {
        $component['maxWidth'] = $this->maxWidth;

        $component['maxWidthClasses'] = $this->maxWidthClasses;
    }
}

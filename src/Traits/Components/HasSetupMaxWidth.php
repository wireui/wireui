<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupMaxWidth
{
    public mixed $maxWidth = null;

    public mixed $maxWidthClasses = null;

    private mixed $maxWidthResolve = null;

    protected function setMaxWidthResolve(string $class): void
    {
        $this->maxWidthResolve = $class;
    }

    protected function setupMaxWidth(array &$component): void
    {
        throw_if(!$this->maxWidthResolve, new WireUiResolveException($this));

        $maxWidths = config("wireui.{$this->config}.max-widths");

        /** @var ComponentPack $maxWidthPack */
        $maxWidthPack = $maxWidths ? resolve($maxWidths) : resolve($this->maxWidthResolve);

        $this->maxWidth = $this->getData('max-width');

        $this->maxWidthClasses = $maxWidthPack->get($this->maxWidth);

        $this->setVariables($component, ['maxWidth', 'maxWidthClasses']);
    }
}

<?php

namespace WireUi\Traits\Components;

use Exception;
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
        throw_if(!$this->maxWidthResolve, new Exception('You must define a max-width resolve.'));

        $maxWidths = config("wireui.{$this->config}.max-widths");

        /** @var ComponentPack $maxWidthPack */
        $maxWidthPack = $maxWidths ? resolve($maxWidths) : resolve($this->maxWidthResolve);

        $this->maxWidth = $this->getMaxWidth();

        $this->maxWidthClasses = $maxWidthPack->get($this->maxWidth);

        $this->setMaxWidthVariables($component);

        $this->smart(['max-width', 'maxWidth']);
    }

    private function getMaxWidth(): mixed
    {
        if ($this->data->has('max-width')) {
            return $this->data->get('max-width');
        }

        if ($this->data->has('maxWidth')) {
            return $this->data->get('maxWidth');
        }

        return config("wireui.{$this->config}.max-width");
    }

    private function setMaxWidthVariables(array &$component): void
    {
        $component['maxWidth'] = $this->maxWidth;

        $component['maxWidthClasses'] = $this->maxWidthClasses;
    }
}

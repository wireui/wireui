<?php

namespace WireUi\Traits\Components;

use Exception;

trait HasSetupSize
{
    public mixed $size = null;

    public mixed $sizeClasses = null;

    protected mixed $sizeResolve = null;

    protected function setSizeResolve(string $class): void
    {
        $this->sizeResolve = $class;
    }

    protected function setupSize(array &$component): void
    {
        throw_if(!$this->sizeResolve, new Exception('You must define a size resolve.'));

        $sizes = config("wireui.{$this->config}.sizes");

        [$this->size, $sizePack] = $this->getDataModifier($sizes, 'size');

        $this->sizeClasses = $sizePack->get($this->size);

        $this->setSizeVariables($component);
    }

    private function setSizeVariables(array &$component): void
    {
        $component['size'] = $this->size;

        $component['sizeClasses'] = $this->sizeClasses;
    }
}

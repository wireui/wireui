<?php

namespace WireUi\Traits\Customization;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupSize
{
    public mixed $size = null;

    public mixed $sizeClasses = null;

    private mixed $sizeResolve = null;

    protected function setSizeResolve(string $class): void
    {
        $this->sizeResolve = $class;
    }

    protected function setupSize(array &$component): void
    {
        throw_if(!$this->sizeResolve, new Exception('You must define a size resolve.'));

        $sizes = config("wireui.{$this->config}.sizes");

        /** @var ComponentPack $sizePack */
        $sizePack = $sizes ? resolve($sizes) : resolve_wireui($this->sizeResolve);

        $this->size = $this->data->get('size') ?? $this->getMatchModifier($sizePack->keys());

        $this->size ??= config("wireui.{$this->config}.size");

        $this->getSizeClasses($sizePack);

        $this->setSizeVariables($component);

        $this->smart([$this->size, 'size']);
    }

    private function getSizeClasses(mixed $sizePack): void
    {
        $this->sizeClasses = $sizePack->get($this->size);

        $this->sizeClasses = check_result($this->sizeClasses);
    }

    private function setSizeVariables(array &$component): void
    {
        $component['size'] = $this->size;

        $component['sizeClasses'] = $this->sizeClasses;
    }
}

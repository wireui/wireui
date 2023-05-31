<?php

namespace WireUi\View\Setup;

use WireUi\Support\ComponentPack;

trait HasSetupSize
{
    public mixed $size = null;

    public mixed $sizeClasses = null;

    /**
     * Setup the size.
     */
    protected function setupSize(array &$component): void
    {
        $sizes = config("wireui.{$this->config}.sizes");

        if (is_null($sizes)) {
            return;
        }

        /** @var ComponentPack $sizePack */
        $sizePack = resolve($sizes);

        $this->size = $this->data->get('size') ?? $this->getMatchModifier($sizePack->keys());

        $this->size ??= config("wireui.{$this->config}.size");

        $this->sizeClasses = $sizePack->get($this->size);

        $this->setSizeVariables($component);

        // $this->custom('size', $sizePack->get($this->size));

        // $this->size = $sizePack->get($this->size);

        // $component['size'] = $sizePack->get($this->size);

        $this->smart([$this->size, 'size']);
    }

    private function setSizeVariables(array &$component): void
    {
        $component['size'] = $this->size;

        $component['sizeClasses'] = $this->sizeClasses;
    }
}

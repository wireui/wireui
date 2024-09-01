<?php

namespace WireUi\Traits\Components;

use WireUi\Attributes\Mount;
use WireUi\Support\ComponentPack;

trait InteractsWithSize
{
    public mixed $size = null;

    public mixed $sizeClasses = null;

    private mixed $sizeResolve = null;

    protected function setSizeResolve(string $class): void
    {
        $this->sizeResolve = $class;
    }

    #[Mount(40)]
    protected function mountSize(): void
    {
        $sizes = config("wireui.{$this->config}.packs.sizes");

        /** @var ComponentPack $sizePack */
        $sizePack = resolve($sizes ?? $this->sizeResolve);

        $this->size = $this->getDataModifier('size', $sizePack);

        $this->sizeClasses = $sizePack->get($this->size);

        $this->setVariables(['size', 'sizeClasses']);
    }
}

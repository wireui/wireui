<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupBlur
{
    public mixed $blur = null;

    public bool $blurless = false;

    public mixed $blurClasses = null;

    protected function setupBlur(): void
    {
        /** @var ComponentPack $blurPack */
        $blurPack = resolve(config("wireui.{$this->config}.packs.blurs"));

        $this->blur = $this->getData('blur');

        $this->blurless = (bool) ($this->getData('blurless') ?? false);

        $this->blurClasses = $blurPack->get($this->blur);

        $this->setVariables(['blur', 'blurless', 'blurClasses']);
    }
}

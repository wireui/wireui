<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupVariant
{
    public mixed $variant = null;

    protected function setupVariant(): void
    {
        /** @var ComponentPack $variantPack */
        $variantPack = resolve(config("wireui.{$this->config}.packs.variants"));

        $this->variant = $this->getDataModifier('variant', $variantPack);

        if (method_exists($this, 'setColorResolve')) {
            $this->setColorResolve($variantPack->get($this->variant));
        }

        if (method_exists($this, 'setVariantPack')) {
            $this->setVariantPack($variantPack);
        }

        $this->setVariables(['variant']);
    }
}

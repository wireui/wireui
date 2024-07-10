<?php

namespace WireUi\Traits\Components;

use WireUi\Support\ComponentPack;

trait HasSetupVariant
{
    public mixed $variant = null;

    private mixed $variantResolve = null;

    protected function setVariantResolve(string $class): void
    {
        $this->variantResolve = $class;
    }

    protected function setupVariant(): void
    {
        $variants = config("wireui.{$this->config}.packs.variants");

        /** @var ComponentPack $variantPack */
        $variantPack = resolve($variants ?? $this->variantResolve);

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

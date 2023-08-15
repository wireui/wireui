<?php

namespace WireUi\Traits\Components;

use WireUi\Exceptions\WireUiResolveException;
use WireUi\Support\ComponentPack;

trait HasSetupVariant
{
    public mixed $variant = null;

    protected mixed $variantResolve = null;

    protected function setVariantResolve(string $class): void
    {
        $this->variantResolve = $class;
    }

    protected function setupVariant(array &$component): void
    {
        throw_if(!$this->variantResolve, new WireUiResolveException($this));

        $variants = config("wireui.{$this->config}.variants");

        /** @var ComponentPack $variantPack */
        $variantPack = $variants ? resolve($variants) : resolve($this->variantResolve);

        $this->variant = $this->getDataModifier('variant', $variantPack);

        if (method_exists($this, 'setColorResolve')) {
            $this->setColorResolve($variantPack->get($this->variant));
        }

        if (method_exists($this, 'setVariantPack')) {
            $this->setVariantPack($variantPack);
        }

        $this->setVariables($component, ['variant']);
    }
}

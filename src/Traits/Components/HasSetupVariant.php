<?php

namespace WireUi\Traits\Components;

use Exception;

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
        throw_if(!$this->variantResolve, new Exception('You must define a variant resolve.'));

        $variants = config("wireui.{$this->config}.variants");

        [$this->variant, $variantPack] = $this->getDataModifier($variants, 'variant');

        if (method_exists($this, 'setColorResolve')) {
            $this->setColorResolve($variantPack->get($this->variant));
        }

        if (method_exists($this, 'setVariantPack')) {
            $this->setVariantPack($variantPack);
        }

        $this->setVariantVariables($component);
    }

    private function setVariantVariables(array &$component): void
    {
        $component['variant'] = $this->variant;
    }
}

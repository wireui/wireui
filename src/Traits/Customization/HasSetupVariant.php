<?php

namespace WireUi\Traits\Customization;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupVariant
{
    public mixed $variant = null;

    private mixed $variantResolve = null;

    protected function setVariantResolve(string $class): void
    {
        $this->variantResolve = $class;
    }

    protected function setupVariant(array &$component): void
    {
        throw_if(!$this->variantResolve, new Exception('You must define a variant resolve.'));

        $variants = config("wireui.{$this->config}.variants");

        /** @var ComponentPack $variantPack */
        $variantPack = $variants ? resolve($variants) : resolve($this->variantResolve);

        $this->variant = $this->data->get('variant') ?? $this->getMatchModifier($variantPack->keys());

        $this->variant ??= config("wireui.{$this->config}.variant");

        $variantClass = $variantPack->get($this->variant);

        $this->setColorResolve($variantClass);

        $this->setVariantVariables($component);

        $this->smart('variant');
    }

    private function setVariantVariables(array &$component): void
    {
        $component['variant'] = $this->variant;
    }
}

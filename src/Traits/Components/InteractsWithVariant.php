<?php

namespace WireUi\Traits\Components;

use Illuminate\Support\Arr;
use WireUi\Attributes\Mount;
use WireUi\Support\ComponentPack;

trait InteractsWithVariant
{
    public mixed $variant = null;

    private mixed $variantResolve = null;

    protected function setVariantResolve(string $class): void
    {
        $this->variantResolve = $class;
    }

    #[Mount(30)]
    protected function mountVariant(): void
    {
        $variants = config("wireui.{$this->config}.packs.variants");

        /** @var ComponentPack $variantPack */
        $variantPack = resolve($variants ?? $this->variantResolve);

        $this->variant = $this->getDataModifier('variant', $variantPack);

        $variantOptions = $variantPack->get($this->variant);

        if (method_exists($this, 'setVariantPack')) {
            $this->setVariantPack($variantPack);
        }

        if (method_exists($this, 'setSizeResolve') && Arr::has($variantOptions, 'size')) {
            $this->setSizeResolve(data_get($variantOptions, 'size'));
        }

        if (method_exists($this, 'setColorResolve') && Arr::has($variantOptions, 'color')) {
            $this->setColorResolve(data_get($variantOptions, 'color'));
        }

        if (method_exists($this, 'setRoundedResolve') && Arr::has($variantOptions, 'rounded')) {
            $this->setRoundedResolve(data_get($variantOptions, 'rounded'));
        }

        $this->setVariables(['variant']);
    }
}

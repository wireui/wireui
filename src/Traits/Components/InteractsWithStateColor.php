<?php

namespace WireUi\Traits\Components;

use WireUi\Attributes\Mount;
use WireUi\Enum\Packs\Color;
use WireUi\Exceptions\WireUiStateColorException;
use WireUi\Support\ComponentPack;
use WireUi\View\Attribute;

trait InteractsWithStateColor
{
    private ?ComponentPack $colorPack = null;

    private ?ComponentPack $variantPack = null;

    private function setColorPack(ComponentPack $colorPack): void
    {
        $this->colorPack = $colorPack;
    }

    private function setVariantPack(ComponentPack $variantPack): void
    {
        $this->variantPack = $variantPack;
    }

    #[Mount(100)]
    protected function mountStateColor(): void
    {
        throw_if(! $this->colorPack || ! $this->variantPack, new WireUiStateColorException($this));

        $this->applyColorModifier(['hover'], 'hover');
        $this->applyColorModifier(['focus'], 'focus');
        $this->applyColorModifier(['hover', 'focus'], 'interaction');
    }

    /**
     * Apply the color modifier to the button, like hover, and focus
     */
    private function applyColorModifier(array $modifiers, string $event): void
    {
        /** @var Attribute|null $attribute */
        $attribute = $this->attributes->attribute($event);

        if (is_null($attribute)) {
            return;
        }

        $variant = $attribute->value();

        $modifierColor = $attribute->expression();

        $hasModifiers = $attribute->modifiers()->isNotEmpty();

        if ($hasModifiers) {
            $modifierColor = $attribute->modifiers()->first();
        }

        /** @var ComponentPack $colorPack */
        $colorPack = $this->colorPack;

        if ($variant) {
            $colors = config($this->getColorConfigName($variant));

            $colorPack = resolve($colors ?? data_get($this->variantPack->get($variant), 'color'));
        }

        if (is_bool($modifierColor) || ! in_array($modifierColor, $colorPack->keys())) {
            $modifierColor = $this->color;
        }

        foreach ($modifiers as $modifier) {
            $modifierClasses = $colorPack->mergeIf($this->useValidation(), Color::INVALIDATED, $modifierColor);

            $this->colorClasses[$modifier] = data_get($modifierClasses, $modifier);
        }

        $this->smartAttributes($attribute->directive());
    }
}

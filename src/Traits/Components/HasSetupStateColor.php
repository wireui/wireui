<?php

namespace WireUi\Traits\Components;

use Illuminate\Support\Arr;
use WireUi\Exceptions\WireUiStateColorException;
use WireUi\Support\ComponentPack;
use WireUi\View\Attribute;

trait HasSetupStateColor
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

    protected function setupStateColor(array &$data): void
    {
        throw_if(!$this->colorPack || !$this->variantPack, new WireUiStateColorException($this));

        $this->applyColorModifier(['hover'], 'hover');
        $this->applyColorModifier(['focus'], 'focus');
        $this->applyColorModifier(['hover', 'focus'], 'interaction');

        $this->serializeColorClasses();

        $this->setVariables($data, ['colorClasses']);
    }

    private function serializeColorClasses(): void
    {
        $this->colorClasses = collect($this->colorClasses)->transform(
            fn ($color) => Arr::toCssClasses($color),
        )->toArray();
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

            $colorPack = $colors ? resolve($colors) : resolve($this->variantPack->get($variant));
        }

        if (!in_array($modifierColor, $colorPack->keys())) {
            $modifierColor = $this->color;
        }

        foreach ($modifiers as $modifier) {
            $this->colorClasses[$modifier] = data_get($colorPack->get($modifierColor), $modifier);
        }

        $this->smartAttributes($attribute->directive());
    }
}

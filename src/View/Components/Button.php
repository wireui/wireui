<?php

namespace WireUi\View\Components;

use WireUi\Support\Buttons\Colors\{Color, ColorPack};
use WireUi\Support\Buttons\Sizes\SizePack;
use WireUi\View\Attribute;
use WireUi\View\Components\Buttons\Base;

class Button extends Base
{
    public function __construct(
        public bool $disabledOnWireLoading = true,
        public bool $block = false,
        public bool $rounded = false,
        public bool $squared = false,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
        public ?string $iconSize = null,
        public ?string $variant = null,
        public ?string $color = null,
        public ?string $size = null,
    ) {
        parent::__construct(
            disabledOnWireLoading: $disabledOnWireLoading,
            label: $label,
            icon: $icon,
            rightIcon: $rightIcon,
            iconSize: $iconSize,
        );
    }

    protected function init(): void
    {
        $this->setupSize();
        $this->setupIconSize();
        $this->setupColor();
    }

    protected function config(string $path): mixed
    {
        return config("wireui.button.{$path}");
    }

    protected function setupSize(): self
    {
        /** @var SizePack $sizePack */
        $sizePack = resolve($this->config('sizes.base'));

        $this->size ??= $this->getMatchModifier($sizePack->keys());
        $this->size ??= $this->config('size');

        $this->attributes = $this->attributes->class(
            $sizePack->get($this->size)
        );

        return $this;
    }

    protected function setupIconSize(): self
    {
        if ($this->iconSize) {
            return $this;
        }

        /** @var SizePack $sizePack */
        $sizePack = resolve($this->config('sizes.icon'));

        $this->iconSize = $sizePack->get($this->size);

        return $this;
    }

    protected function setupColor(): self
    {
        $this->attributes = $this->attributes->class([
            'outline-none inline-flex justify-center items-center group hover:shadow-sm',
            'transition-all ease-in-out duration-200 focus:ring-2 focus:ring-offset-2',
            'disabled:opacity-80 disabled:cursor-not-allowed',
            'rounded-full' => $this->shouldBePill(),
            'rounded'      => $this->shouldBeRounded(),
            'w-full'       => $this->block,
            $this->getCurrentColor(),
        ]);

        return $this;
    }

    protected function shouldBePill(): bool
    {
        return !$this->squared && $this->rounded;
    }

    protected function shouldBeRounded(): bool
    {
        return !$this->squared && !$this->rounded;
    }

    protected function getColorPack(): ColorPack
    {
        $colors = $this->config('colors');

        $this->variant ??= $this->getMatchModifier(array_keys($colors));
        $this->variant ??= $this->config('variant');

        return resolve($colors[$this->variant]);
    }

    protected function getCurrentColor(): string
    {
        $colorPack = $this->getColorPack();

        $this->color ??= $this->getMatchModifier($colorPack->keys());
        $this->color ??= $this->config('color');

        $color = $colorPack->get($this->color);

        $this->applyColorModifier($colorPack, $color, ['hover'], event: 'hover');
        $this->applyColorModifier($colorPack, $color, ['focus'], event: 'focus');
        $this->applyColorModifier($colorPack, $color, ['hover', 'focus'], event: 'interaction');

        return $color;
    }

    /**
     * Apply the color modifier to the button, like hover, and focus
     *
     * @param ColorPack $colorPack
     * @param Color $color
     * @param array<int, string> $modifiers
     * @param string $event
     * @return Color
     */
    protected function applyColorModifier(
        ColorPack $colorPack,
        Color $color,
        array $modifiers,
        string $event,
    ): Color {
        /** @var Attribute|null $attribute */
        $attribute = $this->attributes->attribute($event);

        if (!$attribute) {
            return $color;
        }

        $variant       = $attribute->value();
        $modifierColor = $attribute->expression();
        $hasModifiers  = $attribute->modifiers()->isNotEmpty();

        if ($hasModifiers) {
            $modifierColor = $attribute->modifiers()->first();
        }

        if ($variant) {
            $colorPack = resolve($this->config("colors.{$variant}"));
        }

        if (!is_string($modifierColor)) {
            $modifierColor = $this->color;
        }

        foreach ($modifiers as $modifier) {
            $color->{$modifier} = $colorPack->get($modifierColor)->{$modifier};
        }

        return $color;
    }
}

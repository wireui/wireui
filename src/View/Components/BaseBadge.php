<?php

namespace WireUi\View\Components;

use Illuminate\View\{Component, ComponentAttributeBag};

abstract class BaseBadge extends Component
{
    protected const DEFAULT = 'default';

    private array $smartAttributes = [];

    public function __construct(
        public bool $rounded = false,
        public bool $squared = false,
        public bool $outline = false,
        public bool $flat = false,
        public bool $full = false,
        public ?string $color = null,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
    ) {
    }

    public function render()
    {
        return function (array $data) {
            return view('wireui::components.badge', $this->mergeData($data))->render();
        };
    }

    protected function mergeData(array $data): array
    {
        /** @var ComponentAttributeBag $attributes */
        $attributes         = $data['attributes'];
        $attributes         = $this->mergeClasses($attributes);
        $data['iconSize']   = $this->iconSize($attributes);
        $data['attributes'] = $attributes->except($this->smartAttributes);

        return $data;
    }

    private function mergeClasses(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        return $attributes->class([
            'outline-none inline-flex justify-center items-center group',
            'rounded-full' => !$this->squared && $this->rounded,
            'rounded'      => !$this->squared && !$this->rounded,
            'w-full'       => $this->full,
            $this->size($attributes),
            $this->color($attributes),
        ]);
    }

    private function size(ComponentAttributeBag $attributes): string
    {
        return $this->size
            ? $this->sizes()[$this->size]
            : $this->modifierClasses($attributes, $this->sizes());
    }

    private function iconSize(ComponentAttributeBag $attributes): string
    {
        return $this->size
            ? $this->iconSizes()[$this->size]
            : $this->modifierClasses($attributes, $this->iconSizes());
    }

    private function color(ComponentAttributeBag $attributes): string
    {
        return $this->color
            ? $this->currentColors()[$this->color]
            : $this->modifierClasses($attributes, $this->currentColors());
    }

    private function currentColors(): array
    {
        if ($this->outline) {
            return $this->outlineColors();
        }

        if ($this->flat) {
            return $this->flatColors();
        }

        return $this->defaultColors();
    }

    /**
     * Will find the correct modifier, like sizes, xs, sm given as a component attribute
     * This function will return "default" if no matches are found
     * e.g. The sizes modifiers are: $sizes ['xs' => '...', ...]
     *      <x-badge xs ... /> will return "xs"
     *      <x-badge ... /> will return "default"
     */
    private function findModifier(ComponentAttributeBag $attributes, array $modifiers): string
    {
        $keys      = collect($modifiers)->keys()->except(self::DEFAULT)->toArray();
        $modifiers = $attributes->only($keys)->getAttributes();
        $modifier  = collect($modifiers)->filter()->keys()->first();

        // store the modifier to remove from attributes bag
        if ($modifier && !in_array($modifier, $this->smartAttributes)) {
            $this->smartAttributes[] = $modifier;
        }

        return $modifier ?? self::DEFAULT;
    }

    /** Finds the correct modifier css classes on attributes */
    public function modifierClasses(ComponentAttributeBag $attributes, array $modifiers): string
    {
        $modifier = $this->findModifier($attributes, $modifiers);

        return $modifiers[$modifier];
    }

    abstract public function outlineColors(): array;

    abstract public function flatColors(): array;

    abstract public function defaultColors(): array;

    abstract public function sizes(): array;

    abstract public function iconSizes(): array;
}

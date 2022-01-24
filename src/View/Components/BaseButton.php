<?php

namespace WireUi\View\Components;

use Illuminate\View\{Component, ComponentAttributeBag};

abstract class BaseButton extends Component
{
    protected const DEFAULT = 'default';

    private array $smartAttributes = [];

    public bool $primary;

    public bool $secondary;

    public bool $positive;

    public bool $negative;

    public bool $warning;

    public bool $info;

    public bool $dark;

    public bool $rounded;

    public bool $squared;

    public bool $outline;

    public bool $flat;

    public ?string $color;

    public ?string $size;

    public ?string $label;

    public ?string $icon;

    public ?string $rightIcon;

    public ?string $spinner;

    public ?string $loadingDelay;

    public function __construct(
        bool $primary = false,
        bool $secondary = false,
        bool $positive = false,
        bool $negative = false,
        bool $warning = false,
        bool $info = false,
        bool $dark = false,
        bool $rounded = false,
        bool $squared = false,
        bool $outline = false,
        bool $flat = false,
        ?string $color = null,
        ?string $size = null,
        ?string $label = null,
        ?string $icon = null,
        ?string $rightIcon = null,
        ?string $spinner = null,
        ?string $loadingDelay = null
    ) {
        $this->primary      = $primary;
        $this->secondary    = $secondary;
        $this->positive     = $positive;
        $this->negative     = $negative;
        $this->warning      = $warning;
        $this->info         = $info;
        $this->dark         = $dark;
        $this->rounded      = $rounded;
        $this->squared      = $squared;
        $this->outline      = $outline;
        $this->flat         = $flat;
        $this->color        = $color;
        $this->size         = $size;
        $this->label        = $label;
        $this->icon         = $icon;
        $this->rightIcon    = $rightIcon;
        $this->spinner      = $spinner;
        $this->loadingDelay = $loadingDelay;
    }

    public function render()
    {
        return function (array $data) {
            return view('wireui::components.button', $this->mergeData($data))->render();
        };
    }

    protected function mergeData(array $data): array
    {
        /** @var ComponentAttributeBag $attributes */
        $attributes         = $data['attributes'];
        $attributes         = $this->mergeClasses($attributes);
        $data['disabled']   = (bool) $attributes->get('disabled');
        $data['attributes'] = $attributes->except($this->smartAttributes);

        return $data;
    }

    private function mergeClasses(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        return $attributes->class([
            'focus:outline-none inline-flex justify-center gap-x-2 items-center',
            'transition-all ease-in duration-150 focus:ring-2 focus:ring-offset-2',
            'hover:shadow-sm disabled:opacity-60 disabled:cursor-not-allowed',
            'rounded-full' => !$this->squared && $this->rounded,
            'rounded'      => !$this->squared && !$this->rounded,
            $this->size($attributes),
            $this->getInputColor(),
        ]);
    }

    private function size(ComponentAttributeBag $attributes): string
    {
        return $this->size
            ? $this->sizes()[$this->size]
            : $this->modifierClasses($attributes, $this->sizes());
    }

    private function getInputColor(): string
    {
        if ($this->outline) {
            return $this->outlineColor();
        }

        if ($this->flat) {
            return $this->flatColor();
        }

        return $this->defaultColor();
    }

    abstract protected function getOutlineColors(): array;

    abstract protected function getFlatColors(): array;

    abstract protected function getDefaultColors(): array;

    abstract protected function sizes(): array;

    private function outlineColor(): string
    {
        return $this->getStyleClasses(
            $alias = 'color',
            $colors = $this->getoutlineColors(),
            $default = 'border text-secondary-500 hover:bg-secondary-100 ring-secondary-200
                        dark:ring-secondary-600 dark:border-secondary-600 dark:hover:bg-secondary-700
                        dark:ring-offset-secondary-800'
        );
    }

    private function flatColor(): string
    {
        return $this->getStyleClasses(
            $alias = 'color',
            $colors = $this->getFlatColors(),
            $default = 'text-secondary-500 hover:bg-secondary-100 ring-secondary-200
                        dark:hover:bg-secondary-700 dark:ring-secondary-600
                        dark:ring-offset-secondary-800'
        );
    }

    protected function defaultColor(): string
    {
        return $this->getStyleClasses(
            $alias = 'color',
            $colors = $this->getDefaultColors(),
            $default = 'border text-secondary-500 hover:bg-secondary-100 ring-secondary-200
                        dark:ring-secondary-600 dark:border-secondary-600 dark:hover:bg-secondary-700
                        dark:ring-offset-secondary-800'
        );
    }

    /**
     * Will find the correct modifier, like sizes, xs, sm given as a component attribute
     * This function will return "default" if no matches are found
     * e.g. The sizes modifiers are: $sizes ['xs' => '...', ...]
     *      <x-button xs ... /> will return "xs"
     *      <x-button ... /> will return "default"
     */
    private function findModifier(ComponentAttributeBag $attributes, array $modifiers): string
    {
        $keys      = collect($modifiers)->keys()->except(self::DEFAULT)->toArray();
        $modifiers = $attributes->only($keys)->getAttributes();
        $modifier  = collect($modifiers)->filter()->keys()->first();

        // store the modifier to remove from attributes bag
        if (!in_array($modifier, $this->smartAttributes)) {
            $this->smartAttributes[] = $modifier;
        }

        return $modifier ?? self::DEFAULT;
    }

    /** Finds the correct modifier css classes on attributes */
    public function modifierClasses(ComponentAttributeBag $attributes, array $modifiers): string
    {
        $modifier = $this->findModifier($attributes, $this->sizes());

        return $modifiers[$modifier];
    }

    private function getStyleClasses(string $alias, array $items, string $default): string
    {
        if ($this->{$alias}) {
            return $items[$this->{$alias}];
        }

        foreach ($items as $item => $classes) {
            if ($this->{$item}) {
                return $classes;
            }
        }

        return $default;
    }
}

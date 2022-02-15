<?php

namespace WireUi\View\Components;

use Illuminate\View\{Component, ComponentAttributeBag};

abstract class BaseButton extends Component
{
    protected const DEFAULT = 'default';

    private array $smartAttributes = [];

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

    public ?string $href;

    public function __construct(
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
        ?string $loadingDelay = null,
        ?string $href = null
    ) {
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
        $this->href         = $href;
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
        $data['iconSize']   = $this->iconSize($attributes);
        $data['disabled']   = (bool) $attributes->get('disabled');
        $data['attributes'] = $attributes->except($this->smartAttributes);

        return $data;
    }

    private function mergeClasses(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        return $attributes->class([
            'focus:outline-none inline-flex justify-center items-center',
            'transition-all ease-in duration-100 focus:ring-2 focus:ring-offset-2',
            'hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed',
            'rounded-full' => !$this->squared && $this->rounded,
            'rounded'      => !$this->squared && !$this->rounded,
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
        $modifier = $this->findModifier($attributes, $modifiers);

        return $modifiers[$modifier];
    }

    abstract protected function outlineColors(): array;

    abstract protected function flatColors(): array;

    abstract protected function defaultColors(): array;

    abstract protected function sizes(): array;

    abstract protected function iconSizes(): array;
}

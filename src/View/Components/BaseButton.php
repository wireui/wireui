<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

abstract class BaseButton extends Component
{
    public bool $xs;

    public bool $md;

    public bool $lg;

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
        bool $xs = false,
        bool $md = false,
        bool $lg = false,
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
        $this->xs           = $xs;
        $this->md           = $md;
        $this->lg           = $lg;
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
        $attributes       = $data['attributes'];
        $data['disabled'] = (bool) $attributes->get('disabled');
        $data['classes']  = $this->getClasses();

        return $data;
    }

    protected function getClasses(): string
    {
        $rounded = $this->squared ? '' : ($this->rounded ? 'rounded-full' : 'rounded-md');
        $size    = $this->getSize();
        $classes = "focus:outline-none px-2.5 py-1.5 flex justify-center gap-x-2 items-center
                    transition-all ease-in duration-75 focus:ring-2 focus:ring-offset-2
                    hover:shadow-sm disabled:opacity-60 disabled:cursor-not-allowed {$rounded} {$size}";

        return "{$classes} {$this->getInputColor()}";
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

    abstract protected function getSizes(): array;

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

    private function getSize(): string
    {
        return $this->getStyleClasses($alias = 'size', $this->getSizes(), $default = 'text-sm');
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

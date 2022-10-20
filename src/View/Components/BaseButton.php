<?php

namespace WireUi\View\Components;

use Closure;
use Illuminate\View\ComponentAttributeBag;

abstract class BaseButton extends Component
{
    protected array $smartAttributes = [];

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
        public ?string $spinner = null,
        public ?string $loadingDelay = null,
        public ?string $href = null
    ) {
    }

    public function render(): Closure
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
            'outline-none inline-flex justify-center items-center group',
            'transition-all ease-in duration-150 focus:ring-2 focus:ring-offset-2',
            'hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed',
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

    abstract public function outlineColors(): array;

    abstract public function flatColors(): array;

    abstract public function defaultColors(): array;

    abstract public function sizes(): array;

    abstract public function iconSizes(): array;
}

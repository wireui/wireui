<?php

namespace WireUi\View\Components\Inputs;

use Illuminate\Support\{Collection, Str, Stringable};
use Illuminate\View\{ComponentAttributeBag, ComponentSlot};
use WireUi\View\Components\FormComponent;

class SliderInput extends FormComponent
{
    protected string $size = 'sm';

    public function __construct(
        public bool $md = false,
        public bool $lg = false,
        public bool $range = false,
        public bool $errorless = false,
        public bool $showStops = false,
        public bool $hideTooltip = false,
        public ?string $label = null,
        public ?string $hint = null,
        public ?string $cornerHint = null,
        public Collection|array|null $stops = null,
    ) {
        $this->size = $this->md ? 'md' : $this->size;
        $this->size = $this->lg ? 'lg' : $this->size;

        $this->formatStops();
    }

    protected function getView(): string
    {
        return $this->range
            ? 'wireui::components.inputs.slider.range'
            : 'wireui::components.inputs.slider.index';
    }

    protected function formatStops(): void
    {
        $this->stops = collect($this->stops)->map(
            fn ($item, $key) => is_array($item) ? $item : ['value' => $item, 'label' => is_string($key) ? $key : null]
        )->values();
    }

    public function formatDataSliderRange(ComponentSlot $data): ComponentAttributeBag
    {
        return $this->mergeAttributes((array) $data)['attributes'];
    }

    public function formatDataSlider(ComponentAttributeBag $attributes): array
    {
        return [
            'type' => 'number',
            'min'  => $attributes->has('min') ? $attributes->get('min') : 0,
            'max'  => $attributes->has('max') ? $attributes->get('max') : 100,
            'step' => $attributes->has('step') ? $attributes->get('step') : 1,
        ];
    }

    public function getSliderClasses(?bool $disabled = null): string
    {
        return Str::of('relative w-full align-middle bg-secondary-200 rounded dark:bg-white')
            ->when(!$disabled, fn (Stringable $stringable) => $stringable->append(' cursor-pointer'))
            ->when($this->size === 'sm', fn (Stringable $stringable) => $stringable->append(' my-4 h-1.5'))
            ->when($this->size === 'md', fn (Stringable $stringable) => $stringable->append(' my-4.5 h-2'))
            ->when($this->size === 'lg', fn (Stringable $stringable) => $stringable->append(' my-5 h-2.5'))
            ->when($this->stops->pluck('label')->filter()->isNotEmpty(), fn (Stringable $stringable) => $stringable->append(' mb-8'));
    }

    public function getBarClasses(?bool $disabled = null, bool $hasError = false): string
    {
        return Str::of('absolute rounded-l')
            ->when($disabled, fn (Stringable $stringable) => $stringable->append(' bg-secondary-500 opacity-60'))
            ->when(!$disabled && $hasError, fn (Stringable $stringable) => $stringable->append(' bg-negative-600'))
            ->when(!$disabled && !$hasError, fn (Stringable $stringable) => $stringable->append(' bg-primary-600'))
            ->when($this->size === 'sm', fn (Stringable $stringable) => $stringable->append(' h-1.5'))
            ->when($this->size === 'md', fn (Stringable $stringable) => $stringable->append(' h-2'))
            ->when($this->size === 'lg', fn (Stringable $stringable) => $stringable->append(' h-2.5'));
    }

    public function getStopClasses(): string
    {
        return Str::of('absolute -translate-x-1/2 bg-white rounded-full dark:bg-secondary-400')
            ->when($this->size === 'sm', fn (Stringable $stringable) => $stringable->append(' w-1.5 h-1.5'))
            ->when($this->size === 'md', fn (Stringable $stringable) => $stringable->append(' w-2 h-2'))
            ->when($this->size === 'lg', fn (Stringable $stringable) => $stringable->append(' w-2.5 h-2.5'));
    }

    public function getStopLabelClasses(bool $hasError = false): string
    {
        return Str::of('absolute -translate-x-1/2 text-xs')
            ->when($this->size === 'sm', fn (Stringable $stringable) => $stringable->append(' mt-4'))
            ->when($this->size === 'md', fn (Stringable $stringable) => $stringable->append(' mt-5'))
            ->when($this->size === 'lg', fn (Stringable $stringable) => $stringable->append(' mt-6'))
            ->when($hasError, fn (Stringable $stringable) => $stringable->append(' text-negative-600'))
            ->when(!$hasError, fn (Stringable $stringable) => $stringable->append(' text-gray-700 dark:text-gray-400'));
    }

    public function getButtonGridClasses(): string
    {
        return <<<EOT
            absolute leading-normal text-center -translate-x-1/2
            bg-transparent select-none w-9 h-9 -top-4 z-10
        EOT;
    }

    public function getButtonClasses(?bool $disabled = null): string
    {
        $enabledClasses = <<<EOT
            border-2 bg-white hover:bg-white dark:hover:bg-white
            cursor-grab hover:scale-120
        EOT;

        $disabledClasses = <<<EOT
            border-2 bg-white hover:bg-white dark:hover:bg-white
            ring-transparent cursor-not-allowed
        EOT;

        return $disabled ? $disabledClasses : $enabledClasses;
    }

    public function buttonError(?bool $disabled = null, bool $hasError = false): string
    {
        return $disabled ? 'secondary' : ($hasError ? 'negative' : 'primary');
    }

    public function buttonSizes(): string
    {
        return match ($this->size) {
            'sm' => '2xs',
            'md' => 'xs',
            'lg' => 'sm',
        };
    }
}

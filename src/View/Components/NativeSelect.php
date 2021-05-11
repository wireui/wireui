<?php

namespace WireUi\View\Components;

class NativeSelect extends FormComponent
{
    public ?string $label;

    public ?string $placeholder;

    public ?string $optionValue;

    public ?string $optionLabel;

    /** @var Collection|array|null */
    public $options;

    /** @param Collection|array|null $options */
    public function __construct(
        ?string $label = null,
        ?string $placeholder = null,
        ?string $optionValue = null,
        ?string $optionLabel = null,
        $options = null
    ) {
        $this->label       = $label;
        $this->placeholder = $placeholder;
        $this->optionValue = $optionValue;
        $this->optionLabel = $optionLabel;
        $this->options     = $options;
    }

    protected function getView(): string
    {
        return 'wireui::components.native-select';
    }

    public function defaultClasses(): string
    {
        return 'mt-1 block w-full pl-3 pr-10 py-2 text-base sm:text-sm shadow-sm
                rounded-md border bg-white focus:ring-1 focus:outline-none';
    }

    public function colorClasses(): string
    {
        return 'border-gray-300 focus:ring-indigo-500 focus:border-indigo-500';
    }

    public function errorClasses()
    {
        return 'border-red-400 focus:ring-red-500 focus:border-red-500 text-red-500';
    }
}

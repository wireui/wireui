<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;

class Input extends FormComponent
{
    public function __construct(
        public bool $borderless = false,
        public bool $shadowless = false,
        public ?string $label = null,
        public ?string $hint = null,
        public ?string $cornerHint = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
        public ?string $prefix = null,
        public ?string $suffix = null,
        public ?string $prepend = null,
        public ?string $append = null,
        public bool $errorless = false
    ) {
    }

    protected function getView(): string
    {
        return 'wireui::components.input';
    }

    public function getInputClasses(bool $hasError = false): string
    {
        $defaultClasses = Arr::toCssClasses([
            $this->getDefaultClasses(),
            'pl-8' => $this->prefix || $this->icon,
            'pr-8' => $hasError     || $this->suffix || $this->rightIcon,
        ]);

        if ($hasError) {
            return "{$this->getErrorClasses()} {$defaultClasses}";
        }

        return "{$this->getDefaultColorClasses()} {$defaultClasses}";
    }

    protected function getErrorClasses(): string
    {
        return Arr::toCssClasses([
            'text-negative-900 dark:text-negative-600 placeholder-negative-300 dark:placeholder-negative-500',
            'border border-negative-300 focus:ring-negative-500 focus:border-negative-500' => !$this->borderless,
            'dark:bg-secondary-800 dark:border-negative-600'                               => !$this->borderless,
        ]);
    }

    protected function getDefaultColorClasses(): string
    {
        return Arr::toCssClasses([
            'placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400',
            'dark:placeholder-secondary-500',
            'border border-secondary-300 focus:ring-primary-500 focus:border-primary-500' => !$this->borderless,
            'dark:border-secondary-600'                                                   => !$this->borderless,
        ]);
    }

    protected function getDefaultClasses(): string
    {
        return Arr::toCssClasses([
            'form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none',
            'shadow-sm'                                                          => !$this->shadowless,
            'border-transparent focus:border-transparent focus:ring-transparent' => $this->borderless,
        ]);
    }
}

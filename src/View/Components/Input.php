<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;

class Input extends FormComponent
{
    public function __construct(
        public bool $borderless = false, //todo
        public bool $shadowless = false, //todo
        public ?string $label = null,
        public ?string $description = null,
        public ?string $corner = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
        public ?string $prefix = null,
        public ?string $suffix = null,
        public bool $validated = false,
        public bool $invalidated = false,
        public bool $errorless = false,
    ) {
    }

    protected function getView(): string
    {
        return 'wireui::components.input';
    }

    public function getInputClasses(bool $hasError = false): string
    {
        return Arr::toCssClasses([
            $this->getDefaultClasses(),
            'pl-8'                          => $this->prefix || $this->icon,
            'pr-8'                          => $hasError     || $this->suffix || $this->rightIcon,
            $this->getErrorClasses()        => $hasError,
            $this->getDefaultColorClasses() => !$hasError,
        ]);
    }

    protected function getErrorClasses(): string
    {
        $default = <<<EOT
            text-negative-900 dark:text-negative-600 placeholder-negative-300
            dark:placeholder-negative-500
        EOT;

        $withBorder = <<<EOT
            border border-negative-300 focus:ring-negative-500 focus:border-negative-500
            dark:bg-secondary-800 dark:border-negative-600
        EOT;

        return Arr::toCssClasses([$default, $withBorder => !$this->borderless]);
    }

    protected function getDefaultColorClasses(): string
    {
        $default = <<<EOT
            placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400
            dark:placeholder-secondary-500
        EOT;

        $withBorder = <<<EOT
            border border-secondary-300 focus:ring-primary-500 focus:border-primary-500
            dark:border-secondary-600
        EOT;

        return Arr::toCssClasses([$default, $withBorder => !$this->borderless]);
    }

    protected function getDefaultClasses(): string
    {
        $default = <<<EOT
            form-input block w-full sm:text-sm rounded-md transition
            ease-in-out duration-100 focus:outline-none
        EOT;

        $withShadow = 'shadow-sm';

        $withoutBorder = 'border-transparent focus:border-transparent focus:ring-transparent';

        return Arr::toCssClasses([
            $default,
            $withShadow    => !$this->shadowless,
            $withoutBorder => $this->borderless,
        ]);
    }
}

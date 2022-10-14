<?php

namespace WireUi\View\Components;

use Illuminate\Support\{Str, Stringable};

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
        $defaultClasses = $this->getDefaultClasses();

        if ($this->prefix || $this->icon) {
            $defaultClasses .= ' pl-8';
        }

        if ($hasError || $this->suffix || $this->rightIcon) {
            $defaultClasses .= ' pr-8';
        }

        if ($hasError) {
            return "{$this->getErrorClasses()} {$defaultClasses}";
        }

        return "{$this->getDefaultColorClasses()} {$defaultClasses}";
    }

    protected function getErrorClasses(): string
    {
        return Str::of('text-negative-900 dark:text-negative-600 placeholder-negative-300 dark:placeholder-negative-500')
            ->unless($this->borderless, function (Stringable $stringable) {
                return $stringable
                    ->append(' border border-negative-300 focus:ring-negative-500 focus:border-negative-500')
                    ->append(' dark:bg-secondary-800 dark:border-negative-600');
            });
    }

    protected function getDefaultColorClasses(): string
    {
        return Str::of('placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400')
            ->append(' dark:placeholder-secondary-500')
            ->unless($this->borderless, function (Stringable $stringable) {
                return $stringable
                    ->append(' border border-secondary-300 focus:ring-primary-500 focus:border-primary-500')
                    ->append(' dark:border-secondary-600');
            });
    }

    protected function getDefaultClasses(): string
    {
        return Str::of('form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none')
            ->unless($this->shadowless, fn (Stringable $stringable) => $stringable->append(' shadow-sm'))
            ->when($this->borderless, function (Stringable $stringable) {
                return $stringable->append(' border-transparent focus:border-transparent focus:ring-transparent');
            });
    }
}

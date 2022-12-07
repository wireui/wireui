<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;

class Radio extends FormComponent
{
    protected string $size = 'sm';

    public function __construct(
        public bool $md = false,
        public bool $lg = false,
        public ?string $label = null,
        public ?string $leftLabel = null,
        public ?string $description = null
    ) {
        $this->size = $this->md ? 'md' : $this->size;
        $this->size = $this->lg ? 'lg' : $this->size;
    }

    protected function getView(): string
    {
        return 'wireui::components.radio';
    }

    public function getClasses(bool $hasError): string
    {
        return Arr::toCssClasses([
            "form-radio rounded-full transition ease-in-out duration-100 {$this->size()}",
            'border-secondary-300 text-primary-600 focus:ring-primary-600 focus:border-primary-400'     => !$hasError,
            'dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600' => !$hasError,
            'dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600'             => !$hasError,
            'dark:focus:ring-offset-secondary-800'                                                      => !$hasError,
            'focus:ring-negative-500 ring-negative-500 border-negative-400 text-negative-600'           => $hasError,
            'focus:border-negative-400 dark:focus:border-negative-600 dark:ring-negative-600'           => $hasError,
            'dark:border-negative-600 dark:bg-negative-700 dark:checked:bg-negative-700'                => $hasError,
            'dark:focus:ring-offset-secondary-800 dark:checked:border-negative-700'                     => $hasError,
        ]);
    }

    private function size(): string
    {
        return Arr::toCssClasses([
            'w-5 h-5' => $this->size === 'md',
            'w-6 h-6' => $this->size === 'lg',
        ]);
    }
}

<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public string $color;

    public ?string $label;

    public ?string $hint;

    public ?string $cornerHint;

    public ?string $icon;

    public ?string $rightIcon;

    public ?string $prefix;

    public ?string $suffix;

    public ?string $prepend;

    public ?string $append;

    public function __construct(
        string $color = 'focus:ring-indigo-500 focus:border-indigo-500',
        ?string $label = null,
        ?string $hint = null,
        ?string $cornerHint = null,
        ?string $icon = null,
        ?string $rightIcon = null,
        ?string $prefix = null,
        ?string $suffix = null,
        ?string $prepend = null,
        ?string $append = null
    ) {
        $this->color      = $color;
        $this->label      = $label;
        $this->hint       = $hint;
        $this->cornerHint = $cornerHint;
        $this->icon       = $icon;
        $this->rightIcon  = $rightIcon;
        $this->prefix     = $prefix;
        $this->suffix     = $suffix;
        $this->prepend    = $prepend;
        $this->append     = $append;
    }

    public function render()
    {
        return function (array $data) {
            return view('wireui::components.input', $this->mergeData($data))->render();
        };
    }

    protected function mergeData(array $data): array
    {
        $attributes = $data['attributes'];
        $model      = $attributes->wire('model')->value();

        if (!$attributes->has('name') && $model) {
            $attributes->offsetSet('name', $model);
        }

        if (!$attributes->has('id') && $model) {
            $attributes->offsetSet('id', md5($model));
        }

        $data['name']     = $attributes->get('name');
        $data['id']       = $attributes->get('id');
        $data['disabled'] = (bool)$attributes->get('disabled');

        return $data;
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
        return 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500';
    }

    protected function getDefaultColorClasses(): string
    {
        return "{$this->color} placeholder-gray-400 border-gray-300";
    }

    protected function getDefaultClasses(): string
    {
        return 'shadow-sm block w-full sm:text-sm rounded-md';
    }
}

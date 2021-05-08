<?php

namespace WireUi\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class NativeSelect extends Component
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

    public function render()
    {
        return function (array $data) {
            return view('wireui::components.native-select', $this->mergeData($data))->render();
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

        $data['id']       = $attributes->get('id');
        $data['name']     = $attributes->get('name');
        $data['disabled'] = (bool)$attributes->get('disabled');

        return $data;
    }

    public function defaultClasses(): string
    {
        return 'mt-1 block w-full pl-3 pr-10 py-2 text-base sm:text-sm shadow-sm rounded-md focus:outline-none';
    }

    public function colorClasses(): string
    {
        return 'border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500';
    }

    public function errorClasses()
    {
        return 'border-red-400 focus:ring-red-500 focus:border-red-500 text-red-500';
    }
}

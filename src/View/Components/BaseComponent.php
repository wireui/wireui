<?php

namespace WireUi\View\Components;

use Closure;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\View\{Component, ComponentAttributeBag};

abstract class BaseComponent extends Component
{
    /**
     * Attributes locked.
     */
    protected ?string $config = null;

    private array $smartAttributes = [];

    protected ComponentAttributeBag $data;

    /**
     * Get view name, set config name and render the component.
     */
    abstract protected function getView(): string;

    protected function setConfig(string $config): void
    {
        $this->config = $config;
    }

    public function render(): Closure
    {
        return function (array $data) {
            return view($this->getView(), $this->setupComponent($data))->render();
        };
    }

    /**
     * Methods to setup the component.
     */
    private function setupComponent(array $component): array
    {
        throw_if(!$this->config, new Exception('Component config is required.'));

        $this->data = $component['attributes'];

        /**
         * Customization methods.
         */
        if (method_exists($this, 'setupForm')) {
            $this->setupForm($component);
        }

        if (method_exists($this, 'setupSize')) {
            $this->setupSize($component);
        }

        if (method_exists($this, 'setupIcon')) {
            $this->setupIcon($component);
        }

        if (method_exists($this, 'setupColor')) {
            $this->setupColor($component);
        }

        if (method_exists($this, 'setupRounded')) {
            $this->setupRounded($component);
        }

        /**
         * Component specific methods.
         */
        if (method_exists($this, 'setupCheckbox')) {
            $this->setupCheckbox($component);
        }

        return Arr::set($component, 'attributes', $this->data->except($this->smartAttributes));
    }

    /**
     * Auxiliary methods.
     */
    protected function smart(mixed $attributes): void
    {
        collect(Arr::wrap($attributes))->filter()->each(
            fn ($value) => $this->smartAttributes[] = $value,
        );
    }

    protected function getMatchModifier(array $keys): ?string
    {
        return array_key_first($this->attributes->only($keys)->getAttributes());
    }
}

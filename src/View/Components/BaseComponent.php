<?php

namespace WireUi\View\Components;

use Closure;
use Illuminate\Support\{Arr, Str};
use Illuminate\View\{Component, ComponentAttributeBag};
use WireUi\Facades\WireUi;

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

    private function setConfig(): void
    {
        $this->config = WireUi::components()->resolveByAlias($this->componentName);
    }

    public function render(): Closure
    {
        return function (array $data) {
            return view($this->getView(), $this->executeBaseComponent($data))->render();
        };
    }

    /**
     * Methods to setup the component.
     */
    private function executeBaseComponent(array $component): array
    {
        $this->setConfig();

        $this->data = $component['attributes'];

        // dd(get_class_methods($this));

        foreach (get_class_methods($this) as $method) {
            if (Str::startsWith($method, 'setup')) {
                $this->{$method}($component);
            }
        }

        // /**
        //  * Customization methods.
        //  */
        // if (method_exists($this, 'setupForm')) {
        //     $this->setupForm($component);
        // }

        // if (method_exists($this, 'setupSize')) {
        //     $this->setupSize($component);
        // }

        // if (method_exists($this, 'setupIcon')) {
        //     $this->setupIcon($component);
        // }

        // if (method_exists($this, 'setupColor')) {
        //     $this->setupColor($component);
        // }

        // if (method_exists($this, 'setupRounded')) {
        //     $this->setupRounded($component);
        // }

        // /**
        //  * Component specific methods.
        //  */
        // if (method_exists($this, 'setupCheckbox')) {
        //     $this->setupCheckbox($component);
        // }

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

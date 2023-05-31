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
    // protected array $classes = [];

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

        // dd($this, $this->data);

        if (method_exists($this, 'setupSize')) {
            $this->setupSize($component);
        }

        if (method_exists($this, 'setupColor')) {
            $this->setupColor($component);
        }

        if (method_exists($this, 'setupRounded')) {
            $this->setupRounded($component);
        }

        if (method_exists($this, 'setupForm')) {
            $this->setupForm($component);
        }

        if (method_exists($this, 'setupCustom')) {
            $this->setupCustom($component);
        }

        // return $this->finish($component);

        // dd($this, $this->data);

        return Arr::set($component, 'attributes', $this->data->except($this->smartAttributes));
    }

    // private function finish(array $component)
    // {
    //     collect($this->classes)->each(function ($classes, $key) use (&$component) {
    //         $this->{$key}    = $classes;
    //         $component[$key] = $classes;
    //     });

    //     // dd($this->smartAttributes);

    //     return Arr::set($component, 'attributes', $this->data->except($this->smartAttributes));
    // }

    /**
     * Auxiliary methods.
     */
    protected function smart(mixed $attributes): void
    {
        collect(Arr::wrap($attributes))->filter()->each(
            fn ($value) => $this->smartAttributes[] = $value,
        );
    }

    // protected function custom(string $key, mixed $classes): void
    // {
    //     $this->classes[$key] = Arr::toCssClasses(Arr::wrap($classes));
    // }

    protected function getMatchModifier(array $keys): ?string
    {
        return array_key_first($this->attributes->only($keys)->getAttributes());
    }
}

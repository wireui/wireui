<?php

namespace WireUi\View\Components;

use Closure;
use Illuminate\Support\{Arr, Str};
use Illuminate\View\{Component, ComponentAttributeBag, ComponentSlot};
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
     * Verify if the component has a config or set a new one.
     */
    protected function setConfig(string $config): void
    {
        $this->config = $config;
    }

    private function checkConfig(): void
    {
        $this->config ??= WireUi::components()->resolveByAlias($this->componentName);
    }

    /**
     * Get view name and render the component.
     */
    abstract protected function getView(): string;

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
        $this->checkConfig();

        $this->data = $component['attributes'];

        foreach (get_class_methods($this) as $method) {
            if (Str::startsWith($method, 'setup')) {
                $this->{$method}($component);
            }
        }

        return Arr::set($component, 'attributes', $this->data->except($this->smartAttributes));
    }

    /**
     * Auxiliary methods.
     */
    public function checkSlot(mixed $slot): bool
    {
        return $slot instanceof ComponentSlot;
    }

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

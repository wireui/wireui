<?php

namespace WireUi\View\Components;

use Closure;
use Illuminate\Support\{Arr, Str};
use Illuminate\View\{Component, ComponentAttributeBag};
use WireUi\Facades\WireUi;
use WireUi\Support\ComponentPack;

abstract class BaseComponent extends Component
{
    /**
     * Config name.
     */
    protected ?string $config = null;

    /**
     * Smart attributes to be removed from the attributes bag.
     */
    private array $smartAttributes = [];

    /**
     * Component attributes.
     */
    protected ComponentAttributeBag $data;

    /**
     * Set the component config name.
     */
    private function setConfig(): void
    {
        $this->config = WireUi::components()->resolveByAlias($this->componentName);
    }

    /**
     * Get view name and render the component.
     */
    abstract protected function getView(): string;

    /**
     * Render the component.
     */
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

        foreach ($this->getMethods() as $method) {
            $this->{$method}($component);
        }

        return Arr::set($component, 'attributes', $this->data->except($this->smartAttributes));
    }

    /**
     * Get all methods to setup the component.
     */
    private function getMethods(): array
    {
        $methods = collect(get_class_methods($this))->filter(
            fn ($method) => Str::startsWith($method, 'setup'),
        )->values();

        if ($methods->containsAll(['setupSize', 'setupIconSize'])) {
            $methods = $methods->putEnd('setupIconSize');
        }

        if ($methods->containsAll(['setupVariant', 'setupColor'])) {
            $methods = $methods->putEnd('setupColor');
        }

        if ($methods->containsAll(['setupStateColor'])) {
            $methods = $methods->putEnd('setupStateColor');
        }

        return $methods->values()->toArray();
    }

    /**
     * Get data from the component or config.
     */
    protected function getData(string $attribute, callable $callback = null): mixed
    {
        if ($this->data->has($camel = Str::camel($attribute))) {
            $this->smart($camel);

            return $this->data->get($camel);
        }

        if ($this->data->has($snake = Str::snake($attribute, '-'))) {
            $this->smart($snake);

            return $this->data->get($snake);
        }

        $config = config("wireui.{$this->config}.{$snake}");

        return $callback ? $callback($config) : $config;
    }

    /**
     * Get data modifier from the component or config.
     */
    protected function getDataModifier(mixed $options, string $attribute): mixed
    {
        /** @var ComponentPack $dataPack */
        $dataPack = $options ? resolve($options) : resolve($this->{"{$attribute}Resolve"});

        $value = $this->data->get($attribute) ?? $this->getMatchModifier($dataPack->keys());

        $this->smart([$attribute, ...$dataPack->keys()]);

        $value ??= config("wireui.{$this->config}.{$attribute}");

        return [$value, $dataPack];
    }

    /**
     * Add smart attributes to be removed from the attributes bag.
     */
    protected function smart(mixed $attributes): void
    {
        collect(Arr::wrap($attributes))->filter()->each(
            fn ($value) => $this->smartAttributes[] = $value,
        );
    }

    /**
     * Get the first attribute that matches the given keys.
     */
    protected function getMatchModifier(array $keys): ?string
    {
        return array_key_first($this->attributes->only($keys)->getAttributes());
    }
}

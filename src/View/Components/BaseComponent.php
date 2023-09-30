<?php

namespace WireUi\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\{Arr, Str};
use Illuminate\View\Component;
use WireUi\Facades\WireUi;
use WireUi\Support\ComponentPack;

abstract class BaseComponent extends Component
{
    protected ?string $config = null;

    private array $setVariables = [];

    private array $smartAttributes = [];

    private function setConfig(): void
    {
        $this->config = WireUi::components()->resolveByAlias($this->componentName);
    }

    abstract protected function blade(): View;

    public function render(): Closure
    {
        return function (array $data) {
            return $this->blade()->with($this->runBaseComponent($data))->render();
        };
    }

    private function runBaseComponent(array $data): array
    {
        $this->setConfig();

        if (method_exists($this, 'mount')) {
            $this->mount($data);
        }

        foreach ($this->getMethods() as $method) {
            $this->{$method}($data);
        }

        if (method_exists($this, 'rendered')) {
            $this->rendered($data);
        }

        foreach ($this->setVariables as $attribute) {
            $data[$attribute] = $this->{$attribute};
        }

        if (method_exists($this, 'formable')) {
            $this->formable($data);
        }

        return Arr::set($data, 'attributes', $this->attributes->except($this->smartAttributes));
    }

    private function getMethods(): array
    {
        $methods = collect(get_class_methods($this))->filter(
            fn ($method) => Str::startsWith($method, 'setup'),
        )->values();

        if ($methods->containsAll(['setupWrapper'])) {
            $methods = $methods->putStart('setupWrapper');
        }

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

    protected function getData(string $attribute, callable $callback = null): mixed
    {
        if ($this->attributes->has($kebab = Str::kebab($attribute))) {
            $this->smartAttributes($kebab);

            return $this->attributes->get($kebab);
        }

        if ($this->attributes->has($camel = Str::camel($attribute))) {
            $this->smartAttributes($camel);

            return $this->attributes->get($camel);
        }

        $config = config("wireui.{$this->config}.{$kebab}");

        return $callback ? $callback($config) : $config;
    }

    protected function getDataModifier(string $attribute, ComponentPack $dataPack): mixed
    {
        $value = $this->attributes->get($attribute) ?? $this->getMatchModifier($dataPack->keys());

        $remove = in_array($value, $dataPack->keys()) ? [$value] : [];

        $this->smartAttributes([$attribute, ...$remove]);

        return $value ?? config("wireui.{$this->config}.{$attribute}");
    }

    protected function setVariables(mixed $variables): void
    {
        collect(Arr::wrap($variables))->filter()->each(
            fn ($value) => $this->setVariables[] = $value,
        );
    }

    protected function smartAttributes(mixed $attributes): void
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

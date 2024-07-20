<?php

namespace WireUi\View;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use WireUi\Facades\WireUi;
use WireUi\Support\ComponentPack;

trait InteractsWithVariables
{
    public ?string $config = null;

    private array $setVariables = [];

    private array $smartAttributes = [];

    private function setConfig(): void
    {
        $this->config ??= WireUi::components()->resolveByAlias($this->componentName);
    }

    private function runWireUiComponent(array $data): array
    {
        $this->setConfig();

        $this->bootAttributes();

        foreach ($this->mount as $function) {
            $this->{$function}($data);
        }

        foreach ($this->process as $function) {
            $this->{$function}($data);
        }

        foreach ($this->setVariables as $attribute) {
            $data[$attribute] = $this->{$attribute};
        }

        $data['attributes'] = $this->attributes->except($this->smartAttributes);

        return tap($data, function (array &$data) {
            foreach ($this->finish as $function) {
                $this->{$function}($data);
            }
        });
    }

    protected function getData(string $attribute, mixed $default = null): mixed
    {
        if ($this->attributes->has($kebab = Str::kebab($attribute))) {
            $this->smartAttributes($kebab);

            return $this->attributes->get($kebab);
        }

        if ($this->attributes->has($camel = Str::camel($attribute))) {
            $this->smartAttributes($camel);

            return $this->attributes->get($camel);
        }

        if ($kebab === 'icon-size' && property_exists($this, 'size')) {
            return $this->size;
        }

        return config("wireui.{$this->config}.default.{$kebab}") ?? $default;
    }

    protected function getDataModifier(string $attribute, ComponentPack $dataPack): mixed
    {
        $value = $this->attributes->get($attribute) ?? $this->getMatchModifier($dataPack->keys());

        $remove = in_array($value, $dataPack->keys()) ? [$value] : [];

        $this->smartAttributes([$attribute, ...$remove]);

        return $value ?? config("wireui.{$this->config}.default.{$attribute}");
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

    protected function useValidation(): bool
    {
        return rescue(fn () => $this->useValidationColors, false, false);
    }
}

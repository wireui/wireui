<?php

namespace WireUi\Support;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\View\{ComponentAttributeBag, ComponentSlot};
use Livewire\{Component, WireDirective};

class WireUiSupport
{
    public function components(): ComponentResolver
    {
        return new ComponentResolver();
    }

    public function directives(): BladeDirectives
    {
        return new BladeDirectives();
    }

    public function component(string $name): string
    {
        return (new static())->components()->resolve($name);
    }

    public function checkSlot(mixed $slot): bool
    {
        return $slot instanceof ComponentSlot;
    }

    public function extractAttributes(mixed $property): ComponentAttributeBag
    {
        return $property instanceof ComponentSlot ? $property->attributes : new ComponentAttributeBag();
    }

    public function alpine(string $component, array $data = []): string
    {
        $expressions = $this->toJs($data);

        return "{$component}({$expressions})";
    }

    public function toJs(array $data = []): string
    {
        if (count(array_filter(array_keys($data), 'is_string')) === 0) {
            return "JSON.parse(atob('" . base64_encode(json_encode($data)) . "'))";
        }

        $expressions = '';

        $parse = function ($value) {
            return match (true) {
                $value instanceof WireDirective => $this->entangle($value),
                is_array($value)                => $this->jsonParse($value),
                is_object($value)               => $this->jsonParse($value),
                is_string($value)               => "'" . str_replace("'", "\'", $value) . "'",
                default                         => json_encode($value),
            };
        };

        foreach ($data as $key => $value) {
            $expressions .= "{$key}:{$parse($value)},";
        }

        return "{{$expressions}}";
    }

    private function jsonParse(array|string $value): string
    {
        return "JSON.parse(atob('" . base64_encode(json_encode($value)) . "'))";
    }

    private function entangle(WireDirective $value): string
    {
        if ($value->hasModifier('blur')) {
            return Blade::render("@entangle('{$value}').live");
        }

        return Blade::render("@entangle('{$value}')");
    }

    public static function wireModel(?Component $component, ComponentAttributeBag $attributes): array
    {
        $exists = count($attributes->whereStartsWith('wire:model')->getAttributes()) > 0;

        if (!$component || !$exists) {
            return ['exists' => false];
        }

        /** @var WireDirective $model */
        $model = $attributes->wire('model');

        return [
            'exists'     => $exists,
            'name'       => $model->value(),
            'livewireId' => $component->id(),
            'modifiers'  => [
                'live'     => $model->modifiers()->contains('live'),
                'blur'     => $model->modifiers()->contains('blur'),
                'debounce' => [
                    'exists' => $model->modifiers()->contains('debounce'),
                    'delay'  => (int) Str::of($model->modifiers()->last(default: '250'))->replaceMatches('/[^0-9]/', '')->toString(),
                ],
                'throttle' => [
                    'exists' => $model->modifiers()->contains('throttle'),
                    'delay'  => (int) Str::of($model->modifiers()->last(default: '250'))->replaceMatches('/[^0-9]/', '')->toString(),
                ],
            ],
        ];
    }
}

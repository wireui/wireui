<?php

namespace WireUi\Support;

use Illuminate\Support\Str;
use Illuminate\View\{ComponentAttributeBag, ComponentSlot};
use Livewire\{Component, WireDirective};
use WireUi\Support\{BladeDirectives, ComponentResolver};

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

    public function extractAttributes(mixed $property): ComponentAttributeBag
    {
        return check_slot($property) ? $property->attributes : new ComponentAttributeBag();
    }

    public function alpine(string $component, array $data = []): string
    {
        $expressions = $this->phpToJs($data);

        return "{$component}({{$expressions}})";
    }

    public function phpToJs(array $data = []): string
    {
        $expressions = '';

        $parse = function ($value) {
            if (is_object($value) || is_array($value)) {
                return "JSON.parse(atob('" . base64_encode(json_encode($value)) . "'))";
            } elseif (is_string($value)) {
                return "'" . str_replace("'", "\'", $value) . "'";
            }

            return json_encode($value);
        };

        foreach ($data as $key => $value) {
            $expressions .= "{$key}:{$parse($value)},";
        }

        return "{{$expressions}}";
    }

    public static function wireModel(?Component $component, ComponentAttributeBag $attributes)
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

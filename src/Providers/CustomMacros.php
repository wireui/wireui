<?php

namespace WireUi\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Livewire\WireDirective;
use WireUi\View\Attribute;

class CustomMacros
{
    public static function register(): void
    {
        Arr::macro('toRecursiveCssClasses', function (array $classes): string {
            return Arr::toCssClasses(collect($classes)->map(
                fn ($value) => Arr::toCssClasses(Arr::wrap($value)),
            )->values()->toArray());
        });

        ComponentAttributeBag::macro('attribute', function (string $name): ?Attribute {
            /** @var ComponentAttributeBag $this */
            $attributes = collect($this->whereStartsWith($name)->getAttributes());

            if ($attributes->isEmpty()) {
                return null;
            }

            return new Attribute($attributes->keys()->sort()->first(), $attributes->first());
        });

        ComponentAttributeBag::macro('wireModifiers', function () {
            /**
             * @var WireDirective $model
             * @var ComponentAttributeBag $this
             */
            $model = $this->wire('model');

            return [
                'live' => $model->hasModifier('live'),
                'blur' => $model->hasModifier('blur'),
                'debounce' => [
                    'exists' => $model->hasModifier('debounce'),
                    'delay' => (string) Str::of($model->modifiers()->get(2, '750'))->replace('ms', ''),
                ],
            ];
        });
    }
}

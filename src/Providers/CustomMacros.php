<?php

namespace WireUi\Providers;

use Illuminate\Support\{Arr, Collection, Str};
use Illuminate\View\ComponentAttributeBag;
use Livewire\WireDirective;
use WireUi\View\Attribute;

class CustomMacros
{
    /**
     * Register the Custom Macros.
     */
    public static function register(): void
    {
        Collection::macro('putEnd', function (mixed $value): Collection {
            /** @var Collection $this */
            return $this->reject($value)->push($value);
        });

        Collection::macro('containsAll', function (array $values): bool {
            return collect($values)->every(function ($value) {
                /** @var Collection $this */
                return $this->contains($value);
            });
        });

        ComponentAttributeBag::macro('attribute', function (string $name): ?Attribute {
            /** @var ComponentAttributeBag $this */
            $attributes = collect($this->whereStartsWith($name)->getAttributes());

            if ($attributes->isEmpty()) {
                return null;
            }

            return new Attribute($attributes->keys()->first(), $attributes->first());
        });

        ComponentAttributeBag::macro('wireModifiers', function () {
            /**
             * @var WireDirective $model
             * @var ComponentAttributeBag $this
             */
            $model = $this->wire('model');

            return [
                'defer'    => $model->modifiers()->contains('defer'),
                'lazy'     => $model->modifiers()->contains('lazy'),
                'debounce' => [
                    'exists' => $model->modifiers()->contains('debounce'),
                    'delay'  => (string) Str::of($model->modifiers()->get(1, '750'))->replace('ms', ''),
                ],
            ];
        });
    }
}

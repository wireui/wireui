<?php

namespace WireUi\Providers;

use Illuminate\Support\{Arr, Str};
use Illuminate\View\ComponentAttributeBag;
use WireUi\View\Attribute;

class Macros
{
    public static function register(): void
    {
        Arr::macro('toRecursiveCssClasses', function ($classList): string {
            $classList = Arr::wrap($classList);
            $classes   = [];

            foreach ($classList as $class => $constraint) {
                if (is_numeric($class)) {
                    $classes[] = Arr::toCssClasses($constraint);
                } elseif ($constraint) {
                    $classes[] = $class;
                }
            }

            return implode(' ', $classes);
        });

        ComponentAttributeBag::macro('wireModifiers', function () {
            /** @var ComponentAttributeBag $this */

            /** @var WireDirective $model */
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

        ComponentAttributeBag::macro('attribute', function (string $name): ?Attribute {
            /** @var ComponentAttributeBag $this */
            $attributes = collect($this->whereStartsWith($name)->getAttributes());

            if ($attributes->isEmpty()) {
                return null;
            }

            return new Attribute(
                directive: $attributes->keys()->first(),
                expression: $attributes->first(),
            );
        });
    }
}

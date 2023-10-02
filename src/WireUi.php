<?php

namespace WireUi;

use Illuminate\Support\{Collection, Str};
use Illuminate\View\{ComponentAttributeBag};
use Livewire\{Component, WireDirective};
use WireUi\Support\{ComponentResolver};
use WireUi\View\{BladeDirectives, Components};

class WireUi
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
            } else if (is_string($value)) {
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

    public static function defaultComponents(): Collection
    {
        return collect([
            'alert' => [
                'class' => Components\Alert::class,
                'alias' => 'alert',
            ],
            'avatar' => [
                'class' => Components\Avatar::class,
                'alias' => 'avatar',
            ],
            'badge' => [
                'class' => Components\Badge\Base::class,
                'alias' => 'badge',
            ],
            'mini-badge' => [
                'class' => Components\Badge\Mini::class,
                'alias' => 'mini-badge',
            ],
            'button' => [
                'class' => Components\Button\Base::class,
                'alias' => 'button',
            ],
            'mini-button' => [
                'class' => Components\Button\Mini::class,
                'alias' => 'mini-button',
            ],
            'card' => [
                'class' => Components\Card::class,
                'alias' => 'card',
            ],
            'checkbox' => [
                'class' => Components\Checkbox::class,
                'alias' => 'checkbox',
            ],
            'color-picker' => [
                'class' => Components\ColorPicker::class,
                'alias' => 'color-picker',
            ],
            'datetime-picker' => [
                'class' => Components\DatetimePicker::class,
                'alias' => 'datetime-picker',
            ],
            'dialog' => [
                'class' => Components\Dialog::class,
                'alias' => 'dialog',
            ],
            'dropdown' => [
                'class' => Components\Dropdown\Base::class,
                'alias' => 'dropdown',
            ],
            'dropdown-item' => [
                'class' => Components\Dropdown\Item::class,
                'alias' => 'dropdown-item',
            ],
            'dropdown-header' => [
                'class' => Components\Dropdown\Header::class,
                'alias' => 'dropdown-header',
            ],
            'error' => [
                'class' => Components\Error::class,
                'alias' => 'error',
            ],
            'errors' => [
                'class' => Components\Errors::class,
                'alias' => 'errors',
            ],
            'icon' => [
                'class' => Components\Icon::class,
                'alias' => 'icon',
            ],
            'input' => [
                'class' => Components\Input::class,
                'alias' => 'input',
            ],
            'inputs.wrapper' => [
                'class' => Components\Inputs\Wrapper::class,
                'alias' => 'inputs.wrapper',
            ],
            'inputs.currency' => [
                'class' => Components\Inputs\CurrencyInput::class,
                'alias' => 'inputs.currency',
            ],
            'inputs.maskable' => [
                'class' => Components\Inputs\MaskableInput::class,
                'alias' => 'inputs.maskable',
            ],
            'inputs.number' => [
                'class' => Components\Inputs\NumberInput::class,
                'alias' => 'inputs.number',
            ],
            'inputs.password' => [
                'class' => Components\Inputs\PasswordInput::class,
                'alias' => 'inputs.password',
            ],
            'inputs.phone' => [
                'class' => Components\Inputs\PhoneInput::class,
                'alias' => 'inputs.phone',
            ],
            'label' => [
                'class' => Components\Label::class,
                'alias' => 'label',
            ],
            'link' => [
                'class' => Components\Link::class,
                'alias' => 'link',
            ],
            'modal' => [
                'class' => Components\Modal::class,
                'alias' => 'modal',
            ],
            'modal.card' => [
                'class' => Components\ModalCard::class,
                'alias' => 'modal.card',
            ],
            'native-select' => [
                'class' => Components\NativeSelect::class,
                'alias' => 'native-select',
            ],
            'notifications' => [
                'class' => Components\Notifications::class,
                'alias' => 'notifications',
            ],
            'radio' => [
                'class' => Components\Radio::class,
                'alias' => 'radio',
            ],
            'select' => [
                'class' => Components\Select::class,
                'alias' => 'select',
            ],
            'select.option' => [
                'class' => Components\Select\Option::class,
                'alias' => 'select.option',
            ],
            'select.user-option' => [
                'class' => Components\Select\UserOption::class,
                'alias' => 'select.user-option',
            ],
            'textarea' => [
                'class' => Components\Textarea::class,
                'alias' => 'textarea',
            ],
            'time-picker' => [
                'class' => Components\TimePicker::class,
                'alias' => 'time-picker',
            ],
            'toggle' => [
                'class' => Components\Toggle::class,
                'alias' => 'toggle',
            ],
        ]);
    }
}

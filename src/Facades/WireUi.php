<?php

namespace WireUi\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use WireUi\Support\{BladeDirectives, ComponentResolver, WireUiSupport};
use WireUi\View\Components;

/**
 * @method static ComponentResolver components()
 * @method static BladeDirectives directives()
 * @method static string component(string $name)
 * @method static string|null extractAttributes(mixed $property)
 */
class WireUi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WireUiSupport::class;
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
            'wrapper' => [
                'class' => Components\Wrapper\Base::class,
                'alias' => 'wrapper',
            ],
        ]);
    }
}

<?php

namespace WireUi\Support;

use Illuminate\Support\Collection;
use WireUi\View\Components;

class ComponentResolver
{
    /**
     * Get the component alias from the name.
     */
    public function resolve(string $name): string
    {
        $components = config('wireui.components');

        return $components[$name]['alias'];
    }

    /**
     * Get the component class from the name.
     */
    public function resolveClass(string $name): string
    {
        $components = config('wireui.components');

        return $components[$name]['class'];
    }

    /**
     * Get the component alias from the name.
     */
    public function resolveByAlias(string $name): string
    {
        $components = config('wireui.components');

        return collect($components)->search(fn ($component) => $component['alias'] === $name);
    }

    /**
     * Get default components.
     */
    public function defaultComponents(): Collection
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
            'badge-mini' => [
                'class' => Components\Badge\Mini::class,
                'alias' => 'badge-mini',
            ],
            'button' => [
                'class' => Components\Button::class,
                'alias' => 'button',
            ],
            'buttons.mini' => [
                'class' => Components\Buttons\Mini::class,
                'alias' => 'buttons.mini',
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
                'class' => Components\Dropdown::class,
                'alias' => 'dropdown',
            ],
            'dropdown.item' => [
                'class' => Components\Dropdown\DropdownItem::class,
                'alias' => 'dropdown.item',
            ],
            'dropdown.header' => [
                'class' => Components\Dropdown\DropdownHeader::class,
                'alias' => 'dropdown.header',
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
                'class' => Components\Notification::class,
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

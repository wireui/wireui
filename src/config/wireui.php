<?php

use WireUi\View\Components;

return [
    /*
        |--------------------------------------------------------------------------
        | Icons
        |--------------------------------------------------------------------------
        |
        | The icons config will be used in icon component as default
        | https://heroicons.com
        |
    */
    'icons' => [
        'style' => env('WIREUI_ICONS_STYLE', 'outline'),
    ],

    /*
        |--------------------------------------------------------------------------
        | Modal
        |--------------------------------------------------------------------------
        |
        | The default modal preferences
        |
    */
    'modal' => [
        'zIndex'   => env('WIREUI_MODAL_Z_INDEX', 'z-50'),
        'maxWidth' => env('WIREUI_MODAL_MAX_WIDTH', '2xl'),
        'spacing'  => env('WIREUI_MODAL_SPACING', 'p-4'),
        'align'    => env('WIREUI_MODAL_ALIGN', 'start'),
        'blur'     => env('WIREUI_MODAL_BLUR', false),
    ],

    /*
        |--------------------------------------------------------------------------
        | Components
        |--------------------------------------------------------------------------
        |
        | List with WireUI components.
        | Change the alias to call the component with a different name.
        | Extend the component and replace your changes in this file.
        | Remove the component from this file if you don't want to use.
        |
     */
    'components' => [
        'icon' => [
            'class' => Components\Icon::class,
            'alias' => 'icon',
        ],
        'icon.spinner' => [
            'class' => Components\Icons\Spinner::class,
            'alias' => 'icon.spinner',
        ],
        'input' => [
            'class' => Components\Input::class,
            'alias' => 'input',
        ],
        'textarea' => [
            'class' => Components\Textarea::class,
            'alias' => 'textarea',
        ],
        'label' => [
            'class' => Components\Label::class,
            'alias' => 'label',
        ],
        'error' => [
            'class' => Components\Error::class,
            'alias' => 'error',
        ],
        'errors' => [
            'class' => Components\Errors::class,
            'alias' => 'errors',
        ],
        'inputs.maskable' => [
            'class' => Components\Inputs\MaskableInput::class,
            'alias' => 'inputs.maskable',
        ],
        'inputs.phone' => [
            'class' => Components\Inputs\PhoneInput::class,
            'alias' => 'inputs.phone',
        ],
        'inputs.currency' => [
            'class' => Components\Inputs\CurrencyInput::class,
            'alias' => 'inputs.currency',
        ],
        'button' => [
            'class' => Components\Button::class,
            'alias' => 'button',
        ],
        'button.circle' => [
            'class' => Components\CircleButton::class,
            'alias' => 'button.circle',
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
        'notifications' => [
            'class' => Components\Notifications::class,
            'alias' => 'notifications',
        ],
        'datetime-picker' => [
            'class' => Components\DatetimePicker::class,
            'alias' => 'datetime-picker',
        ],
        'time-picker' => [
            'class' => Components\TimePicker::class,
            'alias' => 'time-picker',
        ],
        'card' => [
            'class' => Components\Card::class,
            'alias' => 'card',
        ],
        'native-select' => [
            'class' => Components\NativeSelect::class,
            'alias' => 'native-select',
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
        'toggle' => [
            'class' => Components\Toggle::class,
            'alias' => 'toggle',
        ],
        'checkbox' => [
            'class' => Components\Checkbox::class,
            'alias' => 'checkbox',
        ],
        'radio' => [
            'class' => Components\Radio::class,
            'alias' => 'radio',
        ],
        'modal' => [
            'class' => Components\Modal::class,
            'alias' => 'modal',
        ],
        'modal.card' => [
            'class' => Components\ModalCard::class,
            'alias' => 'modal.card',
        ],
        'dialog' => [
            'class' => Components\Dialog::class,
            'alias' => 'dialog',
        ],
    ],
];

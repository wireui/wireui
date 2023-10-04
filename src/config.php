<?php

use WireUi\Facades\WireUi;
use WireUi\View\Components;

return [

    'alert' => [

    ],

    'avatar' => [

    ],

    'badge' => [

    ],

    'mini-badge' => [

    ],

    'button' => [

    ],

    'mini-button' => [

    ],

    'card' => [

    ],

    'checkbox' => [

    ],

    'color-picker' => [

    ],

    'datetime-picker' => [

    ],

    'dialog' => [

    ],

    'dropdown' => [

    ],

    'dropdown.item' => [

    ],

    'dropdown.header' => [

    ],

    'error' => [

    ],

    'errors' => [

    ],

    'icon' => [

    ],

    'input' => [

    ],

    'input-currency' => [

    ],

    'input-maskable' => [

    ],

    'input-number' => [

    ],

    'input-password' => [

    ],

    'input-phone' => [

    ],

    'label' => [

    ],

    'link' => [

    ],

    'modal' => [

    ],

    'modal-card' => [

    ],

    'native-select' => [

    ],

    'notifications' => [

    ],

    'radio' => [

    ],

    'select' => [

    ],

    'select.option' => [

    ],

    'select.user-option' => [

    ],

    'textarea' => [

    ],

    'time-picker' => [

    ],

    'toggle' => [

    ],

    'wrapper' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | WireUI Components
    |--------------------------------------------------------------------------
    |
    | Change the alias to call the component with a different name.
    | Extend the component and replace your changes in this file.
    |
     */
    'components' => WireUi::defaultComponents()->merge([
        // 'button' => [
        //     'class' => Components\Button::class,
        //     'alias' => 'new-button',
        // ],
    ])->toArray(),
];

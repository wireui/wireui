<?php

use WireUi\Facades\WireUi;
use WireUi\View\Components;

return [

    'input-number' => [
        'icon' => 'minus',

        'right-icon' => 'plus',
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

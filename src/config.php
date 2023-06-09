<?php

use WireUi\Facades\WireUi;
use WireUi\Support\Buttons\{Colors, Sizes};
use WireUi\View\Components;

return [
    /*
    |--------------------------------------------------------------------------
    | Button
    |--------------------------------------------------------------------------
    |
    | The default button preferences, like colors, styles, sizes, etc.
    |
    | Variant: solid | flat | outline
    | Size: All keys of WireUi\Support\Buttons\Sizes\Base::all()
    | Color: All keys of variants WireUi\Support\Buttons\Colors\{ Solid | Flat | Outline }::all()
    |
    */
    'button' => [
        'variant' => 'solid',
        'size'    => 'md',
        'color'   => null,
        'colors'  => [
            'solid'   => Colors\Solid::class,
            'flat'    => Colors\Flat::class,
            'outline' => Colors\Outline::class,
            'light'   => Colors\Light::class,
        ],
        'sizes' => [
            'base' => Sizes\Base::class,
            'icon' => Sizes\Icon::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Mini Button
    |--------------------------------------------------------------------------
    |
    | The default mini button preferences, like colors, styles, sizes, etc.
    |
    */
    'buttons_mini' => [
        'variant' => 'solid',
        'size'    => 'md',
        'color'   => null,
        'colors'  => [
            'solid'   => Colors\Solid::class,
            'flat'    => Colors\Flat::class,
            'outline' => Colors\Outline::class,
            'light'   => Colors\Light::class,
        ],
        'sizes' => [
            'base' => Sizes\Mini\Base::class,
            'icon' => Sizes\Mini\Icon::class,
        ],
    ],

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
        'variant' => 'outline',
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

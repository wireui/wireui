<?php

use WireUi\Enum\Packs;
use WireUi\Facades\WireUi as WireUiFacade;
use WireUi\View\Components;
use WireUi\WireUi;

return [

    /*
    |--------------------------------------------------------------------------
    | Global Styles
    |--------------------------------------------------------------------------
    |
    | This option controls the global styles for WireUI components.
    |
     */

    'style' => [
        'shadow'  => Packs\Shadow::BASE,
        'rounded' => Packs\Rounded::BASE,
        'color'   => Packs\Color::PRIMARY,
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Configuration
    |--------------------------------------------------------------------------
    |
    | This option controls the default configuration for WireUI components.
    |
     */

    'alert' => [
        'default' => [
            'color'   => GLOBAL_STYLE,
            'rounded' => GLOBAL_STYLE,
            'padding' => Packs\Padding::BASE,
            'variant' => Packs\Variant::FLAT,
        ],
        'packs' => [
            'shadows'  => WireUi\Shadow::class,
            'rounders' => WireUi\Rounded::class,
            'paddings' => WireUi\Alert\Padding::class,
            'variants' => WireUi\Alert\Variant::class,
        ],
    ],

    'avatar' => [
        'default' => [
            'border'  => Packs\Border::THIN,
            'rounded' => Packs\Rounded::FULL,
            'color'   => Packs\Color::SECONDARY,
        ],
        'packs' => [
            'rounders'   => WireUi\Rounded::class,
            'sizes'      => WireUi\Avatar\Size::class,
            'colors'     => WireUi\Avatar\Color::class,
            'borders'    => WireUi\Avatar\Border::class,
            'icon-sizes' => WireUi\Avatar\IconSize::class,
        ],
    ],

    'badge' => [
        'default' => [
            'color'   => GLOBAL_STYLE,
            'rounded' => GLOBAL_STYLE,
            'size'    => Packs\Size::SM,
            'variant' => Packs\Variant::SOLID,
        ],
        'packs' => [
            'rounders'   => WireUi\Rounded::class,
            'variants'   => WireUi\Badge\Variant::class,
            'icon-sizes' => WireUi\Badge\IconSize::class,
            'sizes'      => WireUi\Badge\Size\Base::class,
        ],
    ],

    'mini-badge' => [
        'default' => [
            'color'   => GLOBAL_STYLE,
            'rounded' => GLOBAL_STYLE,
            'size'    => Packs\Size::SM,
            'variant' => Packs\Variant::SOLID,
        ],
        'packs' => [
            'rounders'   => WireUi\Rounded::class,
            'variants'   => WireUi\Badge\Variant::class,
            'icon-sizes' => WireUi\Badge\IconSize::class,
            'sizes'      => WireUi\Badge\Size\Mini::class,
        ],
    ],

    'button' => [
        'default' => [
            'color'   => GLOBAL_STYLE,
            'rounded' => GLOBAL_STYLE,
            'size'    => Packs\Size::MD,
            'variant' => Packs\Variant::SOLID,
        ],
        'packs' => [
            'rounders'   => WireUi\Rounded::class,
            'variants'   => WireUi\Button\Variant::class,
            'icon-sizes' => WireUi\Button\IconSize::class,
            'sizes'      => WireUi\Button\Size\Base::class,
        ],
    ],

    'mini-button' => [
        'default' => [
            'color'   => GLOBAL_STYLE,
            'rounded' => GLOBAL_STYLE,
            'size'    => Packs\Size::MD,
            'variant' => Packs\Variant::SOLID,
        ],
        'packs' => [
            'rounders'   => WireUi\Rounded::class,
            'variants'   => WireUi\Button\Variant::class,
            'icon-sizes' => WireUi\Button\IconSize::class,
            'sizes'      => WireUi\Button\Size\Mini::class,
        ],
    ],

    // 'card' => [
    //     //
    // ],

    // 'checkbox' => [
    //     //
    // ],

    // 'dialog' => [
    //     //
    // ],

    // 'dropdown' => [
    //     //
    // ],

    // 'dropdown.item' => [
    //     //
    // ],

    // 'dropdown.header' => [
    //     //
    // ],

    // 'error' => [
    //     //
    // ],

    // 'errors' => [
    //     //
    // ],

    // 'icon' => [
    //     //
    // ],

    // 'label' => [
    //     //
    // ],

    // 'link' => [
    //     //
    // ],

    // 'modal' => [
    //     //
    // ],

    // 'modal-card' => [
    //     //
    // ],

    // 'notifications' => [
    //     //
    // ],

    // 'radio' => [
    //     //
    // ],

    // 'select.option' => [
    //     //
    // ],

    // 'select.user-option' => [
    //     //
    // ],

    // 'toggle' => [
    //     //
    // ],

    /*
    |--------------------------------------------------------------------------
    | Default Wrapper Configuration
    |--------------------------------------------------------------------------
    |
    | This option controls the default configuration for this components:
    |
    | - color-picker
    | - datetime-picker
    | - input
    | - input-currency
    | - input-maskable
    | - input-number
    | - input-password
    | - input-phone
    | - native-select
    | - select
    | - textarea
    | - time-picker
    |
     */

    'wrapper' => [
        //
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

    'components' => WireUiFacade::defaultComponents()->merge([
        // 'button' => [
        //     'class' => Components\Button::class,
        //     'alias' => 'new-button',
        // ],
    ])->toArray(),
];

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
            'sizes'      => WireUi\Badge\Size\Base::class,
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
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'checkbox' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'color-picker' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'datetime-picker' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'dialog' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'dropdown' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'dropdown.item' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'dropdown.header' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'error' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'errors' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'icon' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'input' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'input-currency' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'input-maskable' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'input-number' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'input-password' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'input-phone' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'label' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'link' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'modal' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'modal-card' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'native-select' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'notifications' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'radio' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'select' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'select.option' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'select.user-option' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'textarea' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'time-picker' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

    // 'toggle' => [
    //     'default' => [
    //         'color'   => GLOBAL_STYLE,
    //         'rounded' => GLOBAL_STYLE,
    //         'padding' => Packs\Padding::BASE,
    //         'variant' => Packs\Variant::FLAT,
    //     ],
    //     'packs' => [
    //         'shadows'  => WireUi\Shadow::class,
    //         'rounders' => WireUi\Rounded::class,
    //         'paddings' => WireUi\Alert\Padding::class,
    //         'variants' => WireUi\Alert\Variant::class,
    //     ],
    // ],

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

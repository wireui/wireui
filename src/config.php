<?php

use WireUi\Support\Buttons\{Colors, Sizes};
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
        'variant' => 'outline',
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
        | Card
        |--------------------------------------------------------------------------
        |
        | The default card preferences
        |
    */
    'card' => [
        'padding' => env('WIREUI_CARD_PADDING', 'px-2 py-5 md:px-4'),
        'shadow'  => env('WIREUI_CARD_SHADOW', 'shadow-md'),
        'rounded' => env('WIREUI_CARD_ROUNDED', 'rounded-lg'),
        'color'   => env('WIREUI_CARD_COLOR', 'bg-white dark:bg-secondary-800'),
    ],

    /*
        |--------------------------------------------------------------------------
        | Button
        |--------------------------------------------------------------------------
        |
        | The default button preferences, like colors, styles, sizes, etc.
        |
        | Style: solid | flat | outline
        | Size: All keys of WireUi\Support\Buttons\Sizes\Base::all()
        | Color: All keys of WireUi\Support\Buttons\Colors\{ Solid | Flat | Outline }::all()
        |
    */
    'button' => [
        'style'  => 'solid',
        'size'   => 'md',
        'color'  => null,
        'colors' => [
            'solid'   => Colors\Solid::class,
            'flat'    => Colors\Flat::class,
            'outline' => Colors\Outline::class,
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
    */
    'buttons_mini' => [
        'style'  => 'solid',
        'size'   => 'md',
        'color'  => null,
        'colors' => [
            'solid'   => Colors\Solid::class,
            'flat'    => Colors\Flat::class,
            'outline' => Colors\Outline::class,
        ],
        'sizes' => [
            'base' => Sizes\Mini\Base::class,
            'icon' => Sizes\Mini\Icon::class,
        ],
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
        'avatar' => [
            'class' => Components\Avatar::class,
            'alias' => 'avatar',
        ],
        'icon' => [
            'class' => Components\Icon::class,
            'alias' => 'icon',
        ],
        'icon.spinner' => [
            'class' => Components\Icons\Spinner::class,
            'alias' => 'icon.spinner',
        ],
        'color-picker' => [
            'class' => Components\ColorPicker::class,
            'alias' => 'color-picker',
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
        'inputs.number' => [
            'class' => Components\Inputs\NumberInput::class,
            'alias' => 'inputs.number',
        ],
        'inputs.password' => [
            'class' => Components\Inputs\PasswordInput::class,
            'alias' => 'inputs.password',
        ],
        'badge' => [
            'class' => Components\Badge::class,
            'alias' => 'badge',
        ],
        'badge.circle' => [
            'class' => Components\CircleBadge::class,
            'alias' => 'badge.circle',
        ],
        'button' => [
            'class' => Components\Button::class,
            'alias' => 'button',
        ],
        'buttons.mini' => [
            'class' => Components\Buttons\Mini::class,
            'alias' => 'buttons.mini',
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

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

    /*
        |--------------------------------------------------------------------------
        | Sizes
        |--------------------------------------------------------------------------
        |
        | List of Sizes used in different WireUI components.
        | Change the size to your personal needs.
        |
     */

    'sizes' => [
        'button' => [
            'xs' => 'text-xs',
            'md' => 'text-md',
            'lg' => 'text-lg',
        ],
    ],
    /*
        |--------------------------------------------------------------------------
        | Classes
        |--------------------------------------------------------------------------
        |
        | List with WireUI components.
        | Change the alias to call the component with a different name.
        | Extend the component and replace your changes in this file.
        | Remove the component from this file if you don't want to use.
        |
     */
    'classes' => [
        'baseButton' => [
            'defaultColor' => 'border text-secondary-500 hover:bg-secondary-100 ring-secondary-200 dark:ring-secondary-600 dark:border-secondary-600 dark:hover:bg-secondary-700 dark:ring-offset-secondary-800',
            'flatColor' => 'text-secondary-500 hover:bg-secondary-100 ring-secondary-200 dark:hover:bg-secondary-700 dark:ring-secondary-600 dark:ring-offset-secondary-800',
            'outlineColor' => 'border text-secondary-500 hover:bg-secondary-100 ring-secondary-200 dark:ring-secondary-600 dark:border-secondary-600 dark:hover:bg-secondary-700 dark:ring-offset-secondary-800',
            'class' => 'focus:outline-none px-2.5 py-1.5 flex justify-center gap-x-2 items-center transition-all ease-in duration-75 focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-60 disabled:cursor-not-allowed',
            'border-radius' => [
                'default' => 'rounded-md',
                'rounded' => 'rounded-full',
            ]
        ],
        'button' => [
            'outlineColors' => [
                'primary' => 'ring-primary-600 text-primary-600 border border-primary-600 hover:bg-primary-50 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',
                'secondary' => 'ring-secondary-600 text-secondary-600 border border-secondary-600 hover:bg-secondary-100 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',
                'positive' => 'ring-positive-500 text-positive-600 border border-positive-600 hover:bg-positive-50 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',
                'negative' => 'ring-negative-500 text-negative-600 border border-negative-600 hover:bg-negative-50 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',
                'warning' => 'ring-warning-500 text-warning-600 border border-warning-600 hover:bg-warning-50 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',
                'info' => 'ring-info-600 text-info-800 border border-info-800 hover:bg-info-50 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',
                'dark' => 'ring-secondary-600 text-secondary-800 border border-secondary-800 hover:bg-secondary-200 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700 dark:text-secondary-500',
            ],
            'flatColors' => [
                'primary' => 'ring-primary-600 text-primary-600 hover:bg-primary-100 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700 dark:ring-primary-700',
                'secondary' => 'ring-secondary-600 text-secondary-600 hover:bg-secondary-100 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700 dark:ring-secondary-700',
                'positive' => 'ring-positive-500 text-positive-600 hover:bg-positive-100 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700 dark:ring-positive-700',
                'negative' => 'ring-negative-600 text-negative-600 hover:bg-negative-100 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700 dark:ring-negative-700',
                'warning' => 'ring-warning-500 text-warning-600 hover:bg-warning-100 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700 dark:ring-warning-700',
                'info' => 'ring-info-600 text-info-600 hover:bg-info-100 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700 dark:ring-info-700',
                'dark' => 'ring-secondary-600 text-secondary-900 hover:bg-secondary-200 dark:ring-offset-secondary-800 dark:hover:bg-secondary-700 dark:ring-dark-700 dark:text-secondary-500',
            ],
            'defaultColors' => [
                'primary' => 'ring-primary-600 text-white bg-primary-500 hover:bg-primary-600 dark:ring-offset-secondary-800 dark:bg-primary-700 dark:ring-primary-700',
                'secondary' => 'ring-secondary-600 text-white bg-secondary-500 hover:bg-secondary-600 dark:ring-offset-secondary-800 dark:bg-secondary-700 dark:ring-secondary-700',
                'positive' => 'ring-positive-500 text-white bg-positive-500 hover:bg-positive-600 dark:ring-offset-secondary-800 dark:bg-positive-700 dark:ring-positive-700',
                'negative' => 'ring-negative-600 text-white bg-negative-500 hover:bg-negative-600 dark:ring-offset-secondary-800 dark:bg-negative-700 dark:ring-negative-700',
                'warning' => 'ring-warning-500 text-white bg-warning-500 hover:bg-warning-600 dark:ring-offset-secondary-800 dark:bg-warning-700 dark:ring-warning-700',
                'info' => 'ring-info-600 text-white bg-info-500 hover:bg-info-600 dark:ring-offset-secondary-800 dark:bg-info-700 dark:ring-info-700',
                'dark' => 'ring-secondary-600 text-white bg-secondary-700 hover:bg-secondary-900 dark:ring-offset-secondary-800 dark:bg-secondary-700 dark:ring-secondary-700',
            ],
            'icon' => 'w-4 h-4 shrink-0',
            'rightIcon' => 'w-4 h-4',
        ],
    ],
];

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
        | Change the keys to call the component with a different name.
        | Extend the component and replace your changes in this file.
        | Remove the component from this file if you don't want to use.
        |
     */
    'components' => [
        'icon'               => Components\Icon::class,
        'icon.spinner'       => Components\Icons\Spinner::class,
        'input'              => Components\Input::class,
        'textarea'           => Components\Textarea::class,
        'label'              => Components\Label::class,
        'error'              => Components\Error::class,
        'errors'             => Components\Errors::class,
        'inputs.maskable'    => Components\Inputs\MaskableInput::class,
        'inputs.phone'       => Components\Inputs\PhoneInput::class,
        'inputs.currency'    => Components\Inputs\CurrencyInput::class,
        'button'             => Components\Button::class,
        'dropdown'           => Components\Dropdown::class,
        'dropdown.item'      => Components\Dropdown\DropdownItem::class,
        'dropdown.header'    => Components\Dropdown\DropdownHeader::class,
        'notifications'      => Components\Notifications::class,
        'datetime-picker'    => Components\DatetimePicker::class,
        'time-picker'        => Components\TimePicker::class,
        'card'               => Components\Card::class,
        'native-select'      => Components\NativeSelect::class,
        'select'             => Components\Select::class,
        'select.option'      => Components\Select\Option::class,
        'select.user-option' => Components\Select\UserOption::class,
        'toggle'             => Components\Toggle::class,
        'checkbox'           => Components\Checkbox::class,
        'radio'              => Components\Radio::class,
        'modal'              => Components\Modal::class,
        'modal.card'         => Components\ModalCard::class,
        'dialog'             => Components\Dialog::class,
    ],
];

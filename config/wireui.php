<?php

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
];

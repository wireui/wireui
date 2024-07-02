<?php

namespace Tests\Unit\Http;

dataset('button::validate', [
    'label' => [
        'attribute' => 'label',
        'rule' => 'string',
    ],
    'variant' => [
        'attribute' => 'variant',
        'rule' => 'string',
    ],
    'color' => [
        'attribute' => 'color',
        'rule' => 'string',
    ],
    'size' => [
        'attribute' => 'size',
        'rule' => 'string',
    ],
    'icon' => [
        'attribute' => 'icon',
        'rule' => 'string',
    ],
    'rightIcon' => [
        'attribute' => 'rightIcon',
        'rule' => 'string',
    ],
    'iconSize' => [
        'attribute' => 'iconSize',
        'rule' => 'string',
    ],
    'rounded' => [
        'attribute' => 'rounded',
        'rule' => 'boolean',
    ],
    'squared' => [
        'attribute' => 'squared',
        'rule' => 'boolean',
    ],
    'bordered' => [
        'attribute' => 'bordered',
        'rule' => 'boolean',
    ],
    'solid' => [
        'attribute' => 'solid',
        'rule' => 'boolean',
    ],
    'outline' => [
        'attribute' => 'outline',
        'rule' => 'boolean',
    ],
    'flat' => [
        'attribute' => 'flat',
        'rule' => 'boolean',
    ],
]);

dataset('button::render', [
    'label' => [
        'attribute' => 'label',
        'value' => 'My Label',
    ],
    'variant' => [
        'attribute' => 'variant',
        'value' => 'solid',
    ],
    'color' => [
        'attribute' => 'color',
        'value' => 'primary',
    ],
    'size' => [
        'attribute' => 'size',
        'value' => 'xl',
    ],
    'icon' => [
        'attribute' => 'icon',
        'value' => 'home',
    ],
    'rightIcon' => [
        'attribute' => 'rightIcon',
        'value' => 'user',
    ],
    'iconSize' => [
        'attribute' => 'iconSize',
        'value' => 'sm',
    ],
    'rounded' => [
        'attribute' => 'rounded',
        'value' => true,
    ],
    'squared' => [
        'attribute' => 'squared',
        'value' => true,
    ],
    'bordered' => [
        'attribute' => 'bordered',
        'value' => true,
    ],
    'solid' => [
        'attribute' => 'solid',
        'value' => true,
    ],
    'outline' => [
        'attribute' => 'outline',
        'value' => true,
    ],
    'flat' => [
        'attribute' => 'flat',
        'value' => true,
    ],
    'light' => [
        'attribute' => 'light',
        'value' => true,
    ],
]);

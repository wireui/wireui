<?php

namespace Tests\Unit\Controllers;

use Symfony\Component\HttpFoundation\Response;

test('it should render the button with attributes', function () {
    $this->getJson(route('wireui.render.button', [
        'type'  => 'primary',
        'label' => 'Click me',
    ]))
        ->assertSee('<button', escape: false)
        ->assertSee('Click me');
});

test('if the malicious attributes are ignored', function () {
    $this->getJson(route('wireui.render.button', [
        ':label' => "strtoupper('Click me')",
    ]))
        ->assertSee('<button', escape: false)
        ->assertDontSee('CLICK ME');
});

test('the button attributes validation', function (array $attributes, array $errors) {
    $this->getJson(route('wireui.render.button', $attributes))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonValidationErrors($errors);
})->with([
    'color' => [
        ['color' => ['invalid-type']],
        ['color' => 'string'],
    ],
    'size' => [
        ['size' => ['invalid-type']],
        ['size' => 'string'],
    ],
    'iconSize' => [
        ['iconSize' => ['invalid-type']],
        ['iconSize' => 'string'],
    ],
    'label' => [
        ['label' => ['invalid-type']],
        ['label' => 'string'],
    ],
    'rightIcon' => [
        ['rightIcon' => ['invalid-type']],
        ['rightIcon' => 'string'],
    ],
    'icon' => [
        ['icon' => ['invalid-type']],
        ['icon' => 'string'],
    ],
    'rounded' => [
        ['rounded' => ['invalid-type']],
        ['rounded' => 'The rounded field must be true or false.'],
    ],
    'squared' => [
        ['squared' => ['invalid-type']],
        ['squared' => 'The squared field must be true or false.'],
    ],
    'bordered' => [
        ['bordered' => ['invalid-type']],
        ['bordered' => 'The bordered field must be true or false.'],
    ],
    'flat' => [
        ['flat' => ['invalid-type']],
        ['flat' => 'The flat field must be true or false.'],
    ],
]);

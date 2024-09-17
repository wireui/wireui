<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

test('it should render the button with attributes', function () {
    $params = ['type' => 'primary', 'label' => 'Click me'];

    $this->getJson(route('wireui.render.button', $params))
        ->assertSee('<button', escape: false)
        ->assertSee('Click me');
});

test('it should ignore the malicious attributes', function () {
    $params = [':label' => "strtoupper('Click me')"];

    $this->getJson(route('wireui.render.button', $params))
        ->assertSee('<button', escape: false)
        ->assertDontSee('strtoupper')
        ->assertDontSee('Click me')
        ->assertDontSee('CLICK ME');
});

test('it should validate the request', function (string $attribute, string $rule) {
    $this->getJson(route('wireui.render.button', [$attribute => ['invalid-value']]))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonValidationErrors([
            $attribute => trans("validation.{$rule}", ['attribute' => Str::of($attribute)->headline()->lower()]),
        ]);
})->with('button::validate');

test('it should render a button', function (string $attribute, string|bool $value) {
    $this->getJson(route('wireui.render.button', [$attribute => $value]))
        ->assertStatus(Response::HTTP_OK)
        ->assertSessionHasNoErrors();
})->with('button::render');

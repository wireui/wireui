<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Symfony\Component\HttpFoundation\Response;
use WireUi\Http\Controllers\ButtonController;

test('it should render the button with attributes', function () {
    $this->getJson(route('wireui.render.button', [
        'type'  => 'primary',
        'label' => 'Click me',
    ]))
        ->assertSee('<button', escape: false)
        ->assertSee('Click me');
});

test('it should ignore the malicious attributes', function () {
    $this->getJson(route('wireui.render.button', [
        ':label' => "strtoupper('Click me')",
    ]))
        ->assertSee('<button', escape: false)
        ->assertDontSee('CLICK ME');
});

test('it should filter the attributes to keep safe', function () {
    $attributes = [
        'color'  => 'primary',
        ':label' => "strtoupper('Click me')",
        ':type'  => "config('app.name')",
    ];

    /** @var ButtonController $controller */
    $controller = resolve(ButtonController::class);

    /** @var ComponentAttributeBag $filteredAttributes */
    $filteredAttributes = $this->invokeMethod($controller, 'attributes', [$attributes]);

    $this->assertSame(['color' => 'primary'], $filteredAttributes->getAttributes());
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

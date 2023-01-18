<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Symfony\Component\HttpFoundation\Response;
use WireUi\Http\Controllers\ButtonController;

use function Pest\Laravel\getJson;

it('should render the button with attributes', function () {
    getJson(route('wireui.render.button', [
        'type'  => 'primary',
        'label' => 'Click me',
    ]))
        ->assertSee('<button', escape: false)
        ->assertSee('Click me');
});

it('should ignore the malicious attributes', function () {
    getJson(route('wireui.render.button', [
        ':label' => "strtoupper('Click me')",
    ]))
        ->assertSee('<button', escape: false)
        ->assertDontSee('CLICK ME');
});

it('should filter the attributes to keep safe', function () {
    $attributes = [
        'color'  => 'primary',
        ':label' => "strtoupper('Click me')",
        ':type'  => "config('app.name')",
    ];

    /** @var ButtonController $controller */
    $controller = resolve(ButtonController::class);

    /** @var ComponentAttributeBag $filteredAttributes */
    $filteredAttributes = $this->invokeMethod($controller, 'attributes', [$attributes]);

    $this->assertSame(
        ['color' => 'primary'],
        $filteredAttributes->getAttributes(),
    );
});

it('should validate the request', function (string $attribute, string $rule) {
    $this->getJson(route('wireui.render.button', [$attribute => ['invalid-value']]))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonValidationErrors([
            $attribute => __("validation.{$rule}", ['attribute' => Str::of($attribute)->headline()->lower()]),
        ]);
})->with([
    'label'     => [
        'attribute' => 'label',
        'rule'      => 'string',
    ],
    'variant'   => [
        'attribute' => 'variant',
        'rule'      => 'string',
    ],
    'color'     => [
        'attribute' => 'color',
        'rule'      => 'string',
    ],
    'size'      => [
        'attribute' => 'size',
        'rule'      => 'string',
    ],
    'icon'      => [
        'attribute' => 'icon',
        'rule'      => 'string',
    ],
    'rightIcon' => [
        'attribute' => 'rightIcon',
        'rule'      => 'string',
    ],
    'iconSize'  => [
        'attribute' => 'iconSize',
        'rule'      => 'string',
    ],
    'rounded'   => [
        'attribute' => 'rounded',
        'rule'      => 'boolean',
    ],
    'squared'   => [
        'attribute' => 'squared',
        'rule'      => 'boolean',
    ],
    'bordered'  => [
        'attribute' => 'bordered',
        'rule'      => 'boolean',
    ],
    'solid'     => [
        'attribute' => 'solid',
        'rule'      => 'boolean',
    ],
    'outline'   => [
        'attribute' => 'outline',
        'rule'      => 'boolean',
    ],
    'flat'      => [
        'attribute' => 'flat',
        'rule'      => 'boolean',
    ],
]);

it('should render a button', function (string $attribute, string|bool $value) {
    getJson(route('wireui.render.button', [$attribute => $value]))
        ->assertStatus(Response::HTTP_OK)
        ->assertSessionHasNoErrors();
})->with([
    'label'     => [
        'attribute' => 'label',
        'value'     => 'My Label',
    ],
    'variant'   => [
        'attribute' => 'variant',
        'value'     => 'solid',
    ],
    'color'     => [
        'attribute' => 'color',
        'value'     => 'primary',
    ],
    'size'      => [
        'attribute' => 'size',
        'value'     => 'xl',
    ],
    'icon'      => [
        'attribute' => 'icon',
        'value'     => 'home',
    ],
    'rightIcon' => [
        'attribute' => 'rightIcon',
        'value'     => 'user',
    ],
    'iconSize'  => [
        'attribute' => 'iconSize',
        'value'     => 'sm',
    ],
    'rounded'   => [
        'attribute' => 'rounded',
        'value'     => true,
    ],
    'squared'   => [
        'attribute' => 'squared',
        'value'     => true,
    ],
    'bordered'  => [
        'attribute' => 'bordered',
        'value'     => true,
    ],
    'solid'     => [
        'attribute' => 'solid',
        'value'     => true,
    ],
    'outline'   => [
        'attribute' => 'outline',
        'value'     => true,
    ],
    'flat'      => [
        'attribute' => 'flat',
        'value'     => true,
    ],
    'light'     => [
        'attribute' => 'light',
        'value'     => true,
    ],
]);

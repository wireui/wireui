<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Symfony\Component\HttpFoundation\Response;
use Tests\Unit\TestCase;
use WireUi\Http\Controllers\ButtonController;

class ButtonControllerTest extends TestCase
{
    public function test_it_should_render_the_button_with_attributes()
    {
        $this->getJson(route('wireui.render.button', [
            'type'  => 'primary',
            'label' => 'Click me',
        ]))
            ->assertSee('<button', escape: false)
            ->assertSee('Click me');
    }

    public function test_if_the_malicious_attributes_are_ignored()
    {
        $this->getJson(route('wireui.render.button', [
            ':label' => "strtoupper('Click me')",
        ]))
            ->assertSee('<button', escape: false)
            ->assertDontSee('CLICK ME');
    }

    public function test_if_the_attributes_safe_filtered()
    {
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
            $filteredAttributes->getAttributes()
        );
    }

    /** @dataProvider validationProvider */
    public function test_the_button_attributes_validation(string $attribute, string $rule)
    {
        $this->getJson(route('wireui.render.button', [$attribute => ['invalid-value']]))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                $attribute => __("validation.{$rule}", ['attribute' => Str::of($attribute)->headline()->lower()]),
            ]);
    }

    public function validationProvider(): array
    {
        return [
            'label' => [
                'attribute' => 'label',
                'rule'      => 'string',
            ],
            'variant' => [
                'attribute' => 'variant',
                'rule'      => 'string',
            ],
            'color' => [
                'attribute' => 'color',
                'rule'      => 'string',
            ],
            'size' => [
                'attribute' => 'size',
                'rule'      => 'string',
            ],
            'icon' => [
                'attribute' => 'icon',
                'rule'      => 'string',
            ],
            'rightIcon' => [
                'attribute' => 'rightIcon',
                'rule'      => 'string',
            ],
            'iconSize' => [
                'attribute' => 'iconSize',
                'rule'      => 'string',
            ],
            'rounded' => [
                'attribute' => 'rounded',
                'rule'      => 'boolean',
            ],
            'squared' => [
                'attribute' => 'squared',
                'rule'      => 'boolean',
            ],
            'bordered' => [
                'attribute' => 'bordered',
                'rule'      => 'boolean',
            ],
            'solid' => [
                'attribute' => 'solid',
                'rule'      => 'boolean',
            ],
            'outline' => [
                'attribute' => 'outline',
                'rule'      => 'boolean',
            ],
            'flat' => [
                'attribute' => 'flat',
                'rule'      => 'boolean',
            ],
        ];
    }

    /** @dataProvider valuesProvider */
    public function test_the_button_attributes(string $attribute, string|bool $value)
    {
        $this->getJson(route('wireui.render.button', [$attribute => $value]))
            ->assertStatus(Response::HTTP_OK)
            ->assertSessionHasNoErrors();
    }

    public function valuesProvider(): array
    {
        return [
            'label' => [
                'attribute' => 'label',
                'value'     => 'My Label',
            ],
            'variant' => [
                'attribute' => 'variant',
                'value'     => 'solid',
            ],
            'color' => [
                'attribute' => 'color',
                'value'     => 'primary',
            ],
            'size' => [
                'attribute' => 'size',
                'value'     => 'xl',
            ],
            'icon' => [
                'attribute' => 'icon',
                'value'     => 'home',
            ],
            'rightIcon' => [
                'attribute' => 'rightIcon',
                'value'     => 'user',
            ],
            'iconSize' => [
                'attribute' => 'iconSize',
                'value'     => 'sm',
            ],
            'rounded' => [
                'attribute' => 'rounded',
                'value'     => true,
            ],
            'squared' => [
                'attribute' => 'squared',
                'value'     => false,
            ],
            'bordered' => [
                'attribute' => 'bordered',
                'value'     => true,
            ],
            'solid' => [
                'attribute' => 'solid',
                'value'     => false,
            ],
            'outline' => [
                'attribute' => 'outline',
                'value'     => true,
            ],
            'flat' => [
                'attribute' => 'flat',
                'value'     => false,
            ],
        ];
    }
}

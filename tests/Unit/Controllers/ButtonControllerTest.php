<?php

namespace Tests\Unit\Controllers;

use Illuminate\View\ComponentAttributeBag;
use Symfony\Component\HttpFoundation\Response;
use Tests\Unit\UnitTestCase;
use WireUi\Http\Controllers\ButtonController;

class ButtonControllerTest extends UnitTestCase
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

    /**
     * @dataProvider validationProvider
     */
    public function test_the_button_attributes_validation(array $attributes, $errors)
    {
        $this->getJson(route('wireui.render.button', $attributes))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors($errors);
    }

    public function validationProvider(): array
    {
        return [
            'color' => [
                'attributes' => [
                    'color' => 'invalid-color',
                ],
                'errors' => ['color'],
            ],
            'size' => [
                'attributes' => [
                    'size' => 'invalid-size',
                ],
                'errors' => ['size'],
            ],
            'iconSize' => [
                'attributes' => [
                    'iconSize' => 'invalid-iconSize',
                ],
                'errors' => ['iconSize'],
            ],
            'label' => [
                'attributes' => [
                    'label' => ['invalid-type'],
                ],
                'errors' => ['label'],
            ],
            'rightIcon' => [
                'attributes' => [
                    'rightIcon' => ['invalid-type'],
                ],
                'errors' => ['rightIcon'],
            ],
            'icon' => [
                'attributes' => [
                    'icon' => ['invalid-type'],
                ],
                'errors' => ['icon'],
            ],
            'rounded' => [
                'attributes' => [
                    'rounded' => ['invalid-type'],
                ],
                'errors' => ['rounded'],
            ],
            'squared' => [
                'attributes' => [
                    'squared' => ['invalid-type'],
                ],
                'errors' => ['squared'],
            ],
            'bordered' => [
                'attributes' => [
                    'bordered' => ['invalid-type'],
                ],
                'errors' => ['bordered'],
            ],
            'flat' => [
                'attributes' => [
                    'flat' => ['invalid-type'],
                ],
                'errors' => ['flat'],
            ],
        ];
    }
}

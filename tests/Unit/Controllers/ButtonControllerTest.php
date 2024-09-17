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
                'errors' => ['color' => 'The selected color is invalid.'],
            ],
            'size' => [
                'attributes' => [
                    'size' => 'invalid-size',
                ],
                'errors' => ['size' => 'The selected size is invalid.'],
            ],
            'iconSize' => [
                'attributes' => [
                    'iconSize' => 'invalid-iconSize',
                ],
                'errors' => ['iconSize' => 'The selected icon size is invalid.'],
            ],
            'label' => [
                'attributes' => [
                    'label' => ['invalid-type'],
                ],
                'errors' => ['label' => 'string'],
            ],
            'rightIcon' => [
                'attributes' => [
                    'rightIcon' => ['invalid-type'],
                ],
                'errors' => ['rightIcon' => 'string'],
            ],
            'icon' => [
                'attributes' => [
                    'icon' => ['invalid-type'],
                ],
                'errors' => ['icon' => 'string'],
            ],
            'rounded' => [
                'attributes' => [
                    'rounded' => ['invalid-type'],
                ],
                'errors' => ['rounded' => 'The rounded field must be true or false.'],
            ],
            'squared' => [
                'attributes' => [
                    'squared' => ['invalid-type'],
                ],
                'errors' => ['squared' => 'The squared field must be true or false.'],
            ],
            'bordered' => [
                'attributes' => [
                    'bordered' => ['invalid-type'],
                ],
                'errors' => ['bordered' => 'The bordered field must be true or false.'],
            ],
            'flat' => [
                'attributes' => [
                    'flat' => ['invalid-type'],
                ],
                'errors' => ['flat' => 'The flat field must be true or false.'],
            ],
        ];
    }
}

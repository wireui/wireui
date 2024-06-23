<?php

namespace Tests\Unit\Providers;

use Illuminate\Config\Repository;
use Illuminate\View\Compilers\BladeCompiler;
use Tests\Unit\TestCase;
use WireUi\Components\TextField\Input;

class RegisterBladeComponentsTest extends TestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);

        tap($app['config'], function (Repository $config) {
            $config->set('wireui.components.input.alias', 'form.input');
        });
    }

    public function test_should_register_the_input_component_with_a_custom_alias(): void
    {
        /** @var BladeCompiler $bladeCompiler */
        $bladeCompiler = resolve(BladeCompiler::class);

        $aliases = $bladeCompiler->getClassComponentAliases();

        $this->assertArrayHasKey('form.input', $aliases, 'The form.input should be registered');

        $this->assertArrayNotHasKey('input', $aliases, "The input shouldn't be registered");

        $this->assertSame($aliases['form.input'], Input::class);
    }
}

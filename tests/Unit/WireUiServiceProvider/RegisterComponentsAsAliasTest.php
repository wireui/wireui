<?php

namespace Tests\Unit\WireUiServiceProvider;

use Illuminate\Config\Repository;
use Illuminate\View\Compilers\BladeCompiler;
use Tests\Unit\TestCase;
use WireUi\View\Components\Input;

class RegisterComponentsAsAliasTest extends TestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);

        /** @var Repository */
        $config = $app['config'];

        $config->set('wireui', array_merge(
            require __DIR__ . '/../../../src/config.php',
            $config->get('wireui', [])
        ));

        $config->set('wireui.components.input.alias', 'form.input');

        $app['config'] = $config;
    }

    public function test_should_register_the_input_component_with_a_custom_alias()
    {
        /** @var BladeCompiler $bladeCompiler */
        $bladeCompiler = resolve(BladeCompiler::class);
        $aliases       = $bladeCompiler->getClassComponentAliases();

        $this->assertArrayHasKey('form.input', $aliases, 'The form.input should be registered');
        $this->assertArrayNotHasKey('input', $aliases, "The input shouldn't be registered");
        $this->assertSame($aliases['form.input'], Input::class);
    }
}

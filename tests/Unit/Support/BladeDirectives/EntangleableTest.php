<?php

namespace Tests\Unit\Support\BladeDirectives;

use Illuminate\Support\Facades\View;
use Illuminate\View\ComponentAttributeBag;
use Tests\Unit\UnitTestCase;

class EntangleableTest extends UnitTestCase
{
    /** @dataProvider fallbackValuesProvider */
    public function test_it_should_render_the_default_value_when_livewire_instance_doest_exists(
        string $fallback,
        string $expected,
    ) {
        $blade = "@entangleable('user.name', {$fallback})";

        $this->blade($blade)->assertSee($expected, escape: false);
    }

    public function fallbackValuesProvider(): array
    {
        return [
            ['null', 'null'],
            ['true', 'true'],
            ['false', 'false'],
            ['1', '1'],
            ['0', '0'],
            ['"foo"', '\'foo\''],
            ['["foo", "bar"]', 'JSON.parse(atob(\'WyJmb28iLCJiYXIiXQ==\'))'],
            ['["foo" => "bar"]', 'JSON.parse(atob(\'eyJmb28iOiJiYXIifQ==\'))'],
            ['["foo" => ["bar" => "baz"]]', 'JSON.parse(atob(\'eyJmb28iOnsiYmFyIjoiYmF6In19\'))'],
            ['["foo" => ["bar" => ["baz" => "qux"]]]', 'JSON.parse(atob(\'eyJmb28iOnsiYmFyIjp7ImJheiI6InF1eCJ9fX0=\'))'],
        ];
    }

    public function test_it_should_render_the_normal_entangle_directive_when_the_livewire_exists()
    {
        $blade = "@entangleable('name', false)";

        View::share('_instance', (object) ['id' => 'foo']);

        $this->blade($blade)->assertSee("window.Livewire.find('fake-id').entangle('name')", escape: false);
    }

    public function test_it_should_render_the_entangle_directive_from_the_wire_model_attribute()
    {
        $blade = <<<'BLADE'
            <div x-data="{
                model: @entangle($attributes->wire('model')),
            }">
                ...
            </div>
        BLADE;

        View::share('_instance', (object) ['id' => 'foo']);
        View::share('attributes', new ComponentAttributeBag(['wire:model' => 'name']));

        $this->blade($blade)->assertSee("window.Livewire.find('fake-id').entangle('name')", escape: false);
    }

    public function test_it_should_render_the_entangle_directive_from_the_wire_model_defer_attribute()
    {
        $blade = <<<'BLADE'
            <div x-data="{
                model: @entangle($attributes->wire('model')).defer,
            }">
                ...
            </div>
        BLADE;

        View::share('__livewire', (object) ['id' => 'foo']);
        View::share('attributes', new ComponentAttributeBag(['wire:model.live' => 'name']));

        $this->blade($blade)->assertSee("window.Livewire.find('fake-id').entangle('name').live", escape: false);
    }

    public function test_it_should_render_the_entangle_directive_from_the_wire_model_blur_attribute()
    {
        $blade = <<<'BLADE'
            <div x-data="{
                model: @entangleable($attributes->wire('model')),
            }">
                ...
            </div>
        BLADE;

        View::share('__livewire', (object) ['id' => 'foo']);
        View::share('attributes', new ComponentAttributeBag(['wire:model.blur' => 'name']));

        $this->blade($blade)->assertSee("window.Livewire.find('fake-id').entangle('name').live", escape: false);
    }
}

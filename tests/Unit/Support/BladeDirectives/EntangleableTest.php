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
            ['null', '@toJs(null)'],
            ['true', '@toJs(true)'],
            ['false', '@toJs(false)'],
            ['1', '@toJs(1)'],
            ['0', '@toJs(0)'],
            ['"foo"', '@toJs("foo")'],
            ['["foo", "bar"]', '@toJs(["foo", "bar"])'],
            ['["foo" => "bar"]', '@toJs(["foo" => "bar"])'],
            ['["foo" => ["bar" => "baz"]]', '@toJs(["foo" => ["bar" => "baz"]])'],
            ['["foo" => ["bar" => ["baz" => "qux"]]]', '@toJs(["foo" => ["bar" => ["baz" => "qux"]]])'],
        ];
    }

    public function test_it_should_render_the_normal_entangle_directive_when_the_livewire_exists()
    {
        $blade = "@entangleable('name', false)";

        View::share('_instance', (object) ['id' => 'foo']);

        $this->blade($blade)->assertSee("@entangle('name')", escape: false);
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

        $this->blade($blade)->assertSee("window.Livewire.find('foo').entangle('name')", escape: false);
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

        View::share('_instance', (object) ['id' => 'foo']);
        View::share('attributes', new ComponentAttributeBag(['wire:model' => 'name']));

        $this->blade($blade)->assertSee("window.Livewire.find('foo').entangle('name').defer", escape: false);
    }
}

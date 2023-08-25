<?php

namespace Tests\Unit\Support\BladeDirectives;

use Illuminate\Support\Facades\View;
use Illuminate\View\ComponentAttributeBag;
use Tests\Unit\UnitTestCase;

class EntangleableTest extends UnitTestCase
{
    public function test_it_should_render_the_entangle_directive_from_the_wire_model_attribute()
    {
        $blade = <<<'BLADE'
            <div x-data="{
                model: @entangleable($attributes->wire('model')),
            }">
                ...
            </div>
        BLADE;

        View::share('__livewire', new LivewireComponent());
        View::share('attributes', new ComponentAttributeBag(['wire:model' => 'name']));

        $this->blade($blade)->assertSee("@entangle(\$attributes->wire('model'))", escape: false);
    }

    public function test_it_should_render_the_entangle_directive_from_the_wire_model_live_attribute()
    {
        $blade = <<<'BLADE'
            <div x-data="{
                model: @entangleable($attributes->wire('model')),
            }">
                ...
            </div>
        BLADE;

        View::share('__livewire', new LivewireComponent());
        View::share('attributes', new ComponentAttributeBag(['wire:model.live' => 'name']));

        $this->blade($blade)->assertSee("@entangle(\$attributes->wire('model'))", escape: false);
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

        View::share('__livewire', new LivewireComponent());
        View::share('attributes', new ComponentAttributeBag(['wire:model.blur' => 'name']));

        $this->blade($blade)->assertSee("@entangle(\$attributes->wire('model')).live", escape: false);
    }
}

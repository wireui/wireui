<?php

namespace Tests\Browser\SliderInput;

use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_badges_without_errors(): void
    {
        Livewire::test(Component::class)
            ->assertSee('Label')
            ->assertSee('Primary')
            ->assertSee('Secondary')
            ->assertSee('Positive')
            ->assertSee('Negative')
            ->assertSee('Info')
            ->assertSee('Dark');
    }
}

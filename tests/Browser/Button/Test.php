<?php

namespace Tests\Browser\Button;

use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_buttons_without_errors()
    {
        Livewire::test(Component::class)
            ->assertSee('Label')
            ->assertSee('primary')
            ->assertSee('secondary')
            ->assertSee('positive')
            ->assertSee('negative')
            ->assertSee('info')
            ->assertSee('dark');
    }
}

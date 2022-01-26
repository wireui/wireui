<?php

namespace Tests\Browser\Button;

use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_buttons_without_errors(): void
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

    /** @test */
    public function it_should_render_a_tag_buttons_without_errors(): void
    {
        Livewire::test(ATagComponent::class)
            ->assertSeeHtml('#0')
            ->assertSeeHtml('#1')
            ->assertSeeHtml('#2')
            ->assertSeeHtml('#3')
            ->assertSeeHtml('#4')
            ->assertSeeHtml('#5')
            ->assertSeeHtml('#6')
            ->assertSeeHtml('#7');
    }
}

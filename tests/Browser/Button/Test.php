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
            ->assertSeeHtml('<a')
            ->assertSeeHtml('href="#0"')
            ->assertSeeHtml('href="#1"')
            ->assertSeeHtml('href="#2"')
            ->assertSeeHtml('href="#3"')
            ->assertSeeHtml('href="#4"')
            ->assertSeeHtml('href="#5"')
            ->assertSeeHtml('href="#6"')
            ->assertSeeHtml('href="#7"');
    }
}

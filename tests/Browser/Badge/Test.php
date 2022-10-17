<?php

namespace Tests\Browser\Badge;

use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_badges_without_errors(): void
    {
        Livewire::test(BadgeComponent::class)
            ->assertSee('Label')
            ->assertSee('primary')
            ->assertSee('secondary')
            ->assertSee('positive')
            ->assertSee('negative')
            ->assertSee('info')
            ->assertSee('dark');
    }
}

<?php

namespace Tests\Browser\Badge;

use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    public function test_it_should_render_badges_without_errors(): void
    {
        Livewire::test(BadgeComponent::class)
            ->assertSee('Label')
            ->assertSee('Primary')
            ->assertSee('Secondary')
            ->assertSee('Positive')
            ->assertSee('Negative')
            ->assertSee('Info')
            ->assertSee('Dark');
    }
}

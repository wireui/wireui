<?php

namespace Tests\Browser\Badge;

use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_badge_without_errors(): void
    {
        Livewire::test(BadgeComponent::class)
            ->assertSeeHtml('rounded')
            ->assertSeeHtml('p-1.5')
            ->assertSeeHtml('bg-gray-100 text-gray-800')
            ->assertSeeHtml('bg-blue-100 text-blue-800')
            ->assertSeeHtml('bg-yellow-100 text-yellow-800')
            ->assertSeeHtml('bg-red-100 text-red-800');
        ;
    }
}

<?php

namespace Tests\Browser\Alert;

use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_alert_without_errors(): void
    {
        Livewire::test(AlertComponent::class)
            ->assertSee('heading')
            ->assertSee('text')
            ->assertSee('dismiss')
            ->assertSee('shadow')
            ->assertSeeHtml('<svg class=')
            ->assertSeeHtml('bg-gray-50')
            ->assertSeeHtml('text-gray-700')
            ->assertSeeHtml('bg-blue-50')
            ->assertSeeHtml('text-blue-700')
            ->assertSeeHtml('bg-yellow-50')
            ->assertSeeHtml('text-yellow-700')
            ->assertSeeHtml('bg-green-50')
            ->assertSeeHtml('text-green-700')
            ->assertSeeHtml('bg-red-50')
            ->assertSeeHtml('text-red-700');
    }
}

<?php

namespace Tests\Browser\Avatar;

use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_avatar_without_errors(): void
    {
        Livewire::test(AvatarComponent::class)
            ->assertSee('border')
            ->assertSee('text')
            ->assertSeeHtml('inline-flex')
            ->assertSeeHtml('inline-block')
            ->assertSeeHtml('<svg class=')
            ->assertSeeHtml('w-6 h-6')
            ->assertSeeHtml('w-8 h-8')
            ->assertSeeHtml('w-10 h-10')
            ->assertSeeHtml('w-12 h-12')
            ->assertSeeHtml('w-14 h-14')
            ->assertSeeHtml('w-full')
        ;
    }
}

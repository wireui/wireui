<?php

namespace Tests\Browser\Skeleton;

use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_skeleton_without_errors(): void
    {
        Livewire::test(SkeletonComponent::class)
            ->assertSee('animate-pulse');
    }
}

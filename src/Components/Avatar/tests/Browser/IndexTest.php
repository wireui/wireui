<?php

namespace WireUi\Components\Avatar\tests\Browser;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class IndexTest extends BrowserTestCase
{
    public function test_avatar_component(): void
    {
        Livewire::visit(new class extends Component
        {
            public bool $show = false;

            public function toggle(): void
            {
                $this->show = ! $this->show;
            }

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-button wire:click="toggle" dusk="button" label="Click" />

                        <x-avatar
                            dusk="avatar"
                            :label="$show ? 'AB' : null"
                            :icon="!$show ? 'x-mark' : null"
                        />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertPresent('@avatar > svg')
            ->click('@button')
            ->waitForTextIn('@avatar > span', 'AB');
    }
}

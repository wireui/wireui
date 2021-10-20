<?php

namespace Tests\Browser\Dialog;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class ConfirmDialogTest extends BrowserTestCase
{
    /** @test */
    public function it_should_perform_accept_and_reject_action()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $this->showConfirmDialog($browser))
                ->pause(200)
                ->assertSee('This is a title')
                ->waitUsing(5, 75, fn () => $browser->assertSee('Confirm it'))
                ->assertSee('Confirm it')
                ->press('Confirm it')
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@events', 'accepted'))
                ->tap(fn (Browser $browser) => $this->showConfirmDialog($browser))
                ->pause(200)
                ->press('Decline')
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@events', 'accepted, rejected'));
        });
    }

    private function showConfirmDialog(Browser $browser): void
    {
        $browser->script("
            window.\$wireui.confirmDialog({
                title: 'This is a title',
                accept: {
                    label: 'Confirm it',
                    execute() {
                        window.livewire.emit('addEvent', 'accepted')
                    }
                },
                reject: {
                    label: 'Decline',
                    execute() {
                        window.livewire.emit('addEvent', 'rejected')
                    }
                }
            })
        ");
    }
}

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
            $this->visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $this->showConfirmDialog($browser))
                ->pause(200)
                ->assertSee('This is a title')
                ->waitUsing(7, 100, fn () => $browser->assertSee('Confirm it'))
                ->assertSee('Confirm it')
                ->press('Confirm it')
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@events', 'accepted'))
                ->tap(fn (Browser $browser) => $this->showConfirmDialog($browser))
                ->pause(200)
                ->press('Decline')
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@events', 'accepted, rejected'));
        });
    }

    /** @test */
    public function it_should_prevent_twice_calls_on_accept_and_reject_action()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $this->showConfirmDialog($browser))

                ->waitForText($title = 'This is a title')
                ->assertSee($title)

                ->waitForText($action = 'Confirm it')
                ->assertSee($action)

                ->press('Confirm it')
                ->assertScript(<<<JS
                    document.querySelector('[x-ref="accept"]').firstElementChild.hasAttribute('disabled');
                    document.querySelector('[x-ref="reject"]').firstElementChild.hasAttribute('disabled');
                JS)
                ->press('Decline')
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@events', 'accepted'));
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

<?php

namespace Tests\Browser\Notifications;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_show_notification_from_directive_and_call_accept_and_reject_methods()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertSee('notifications test')
                ->click('@button.test.directive')
                ->waitUsing(5, 75, fn () => $browser->assertSee('Confirm Directive'))
                ->press('Confirm Directive')
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@value', 'Accepted'))
                ->click('@button.test.directive')
                ->press('Cancel Directive')
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@value', 'Rejected'));
        });
    }

    /** @test */
    public function it_should_show_simple_notification_from_component_call()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->click('@button.test.simple_notification')
                ->waitForLivewire()
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser
                        ->assertSee('Success title')
                        ->assertSee('Success description');
                });
        });
    }

    /** @test */
    public function it_should_show_confirmation_with_single_callback_from_component_call()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->click('@button.test.call_confirm_action_with_single_callback')
                ->waitForLivewire()
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->script('getElementByXPath("//button[text()=\'Confirm it\']").click();');
                })->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@value', 'Confirmed');
                });
        });
    }

    /** @test */
    public function it_should_show_confirmation_with_multiple_callbacks_and_events_from_component_call()
    {
        $this->browse(function (Browser $browser) {
            $duskButton = '@button.test.call_confirm_action_with_multiples_callbacks_and_events';

            Livewire::visit($browser, Component::class)
                ->click($duskButton)
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->script('getElementByXPath("//button[text()=\'Accept\']").click();');
                })
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@value', 'Jetete');
                })
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@events', 'onClose');
                })
                ->click($duskButton)
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->script('getElementByXPath("//button[text()=\'Reject\']").click();');
                })
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@value', 'Xablaw');
                })
                ->click('@button.clear_events')
                ->click($duskButton)
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->script('getElementByXPath("//span[text()=\'Close\']").parentNode.click();');
                })
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@events', 'onClose,onDismiss');
                })
                ->click('@button.clear_events')
                ->waitUsing(5, 75, fn () => $browser->assertMissing('@events'))
                ->click($duskButton)
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@events', 'onClose,onTimeout');
                });
        });
    }

    /** @test */
    public function it_should_show_simple_notification_from_js_call()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->click('@button.test.js.simple_notification')
                ->waitUsing(5, 75, fn () => $browser->assertSee('My Simple Notification from js'));
        });
    }

    /** @test */
    public function it_should_show_complex_notification_from_js_call()
    {
        $this->browse(function (Browser $browser) {
            $duskButton = '@button.test.js.complex_notification';

            Livewire::visit($browser, Component::class)
                ->click($duskButton)
                ->waitUsing(5, 75, fn () => $browser->assertSee('My Complex Notification from js'))
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->script('getElementByXPath("//button[text()=\'Delete\']").click();');
                })->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@value', 'deleted');
                })->click($duskButton)
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@events', 'onClose');
                })->waitUsing(5, 75, function () use ($browser) {
                    return $browser->script('getElementByXPath("//button[text()=\'No delete\']").click();');
                })->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@value', 'delete canceled');
                });
        });
    }

    /** @test */
    public function it_should_redirect_when_notification_is_closed()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->click('@button.test.redirect_on_close_notification')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->script('getElementByXPath("//span[text()=\'Close\']").parentNode.click();');
                })->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertFragmentIs('redirected');
                });
        });
    }
}

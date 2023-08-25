<?php

namespace Tests\Browser\Notifications;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_show_notification_from_directive_and_call_accept_and_reject_methods()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('notifications test')
                ->click('@button.test.directive')
                ->waitForText('Confirm Directive')
                ->press('Confirm Directive')
                ->waitForTextIn('@value', 'Accepted')
                ->click('@button.test.directive')
                ->press('Cancel Directive')
                ->waitForTextIn('@value', 'Rejected');
        });
    }

    /** @test */
    public function it_should_show_simple_notification_from_component_call()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->click('@button.test.simple_notification')
                ->tap(fn () => $browser->waitForLivewire())
                ->pause(100)
                ->waitUsing(7, 100, function () use ($browser) {
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
            $this->visit($browser, Component::class)
                ->click('@button.test.call_confirm_action_with_single_callback')
                ->waitForLivewire()
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->script('getElementByXPath("//button[text()=\'Confirm it\']").click();');
                })
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@value', 'Confirmed');
                });
        });
    }

    /** @test */
    public function it_should_show_confirmation_with_multiple_callbacks_and_events_from_component_call()
    {
        $this->browse(function (Browser $browser) {
            $duskButton = '@button.test.call_confirm_action_with_multiples_callbacks_and_events';

            $this->visit($browser, Component::class)
                ->click($duskButton)
                ->tap(fn () => $browser->waitForLivewire())
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->script('getElementByXPath("//button[text()=\'Accept\']").click();');
                })
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@value', 'Jetete');
                })
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@events', 'onClose');
                })
                ->click($duskButton)
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->script('getElementByXPath("//button[text()=\'Reject\']").click();');
                })
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@value', 'Xablaw');
                })
                ->click('@button.clear_events')
                ->click($duskButton)
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->script('getElementByXPath("//span[text()=\'Close\']").parentNode.click();');
                })
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@events', 'onClose,onDismiss');
                })
                ->click('@button.clear_events')
                ->pause(100)
                ->waitUsing(7, 100, fn () => $browser->assertMissing('onClose,onDismiss'))
                ->click($duskButton)
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@events', 'onClose,onTimeout');
                });
        });
    }

    /** @test */
    public function it_should_show_simple_notification_from_js_call()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->click('@button.test.js.simple_notification')
                ->waitUsing(7, 100, fn () => $browser->assertSee('My Simple Notification from js'));
        });
    }

    /** @test */
    public function it_should_show_complex_notification_from_js_call()
    {
        $this->browse(function (Browser $browser) {
            $duskButton = '@button.test.js.complex_notification';

            $this->visit($browser, Component::class)
                ->click($duskButton)
                ->waitUsing(7, 100, fn () => $browser->assertSee('My Complex Notification from js'))
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->script('getElementByXPath("//button[text()=\'Delete\']").click();');
                })->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@value', 'deleted');
                })->click($duskButton)
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@events', 'onClose');
                })->waitUsing(7, 100, function () use ($browser) {
                    return $browser->script('getElementByXPath("//button[text()=\'No delete\']").click();');
                })->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@value', 'delete canceled');
                });
        });
    }

    /** @test */
    public function it_should_redirect_when_notification_is_closed()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->click('@button.test.redirect_on_close_notification')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->script('getElementByXPath("//span[text()=\'Close\']").parentNode.click();');
                })
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertFragmentIs('redirected');
                });
        });
    }
}

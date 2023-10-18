<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Livewire\{Attributes\On, Component, Livewire};
use Tests\Browser\BrowserTestCase;
use WireUi\Traits\WireUiActions;

class NotificationsTest extends BrowserTestCase
{
    public function component(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            use WireUiActions;

            public $value = null;

            public array $events = [];

            #[On('setValue')]
            public function setValue($anyValue): void
            {
                $this->value = $anyValue;
            }

            #[On('addEvent')]
            public function addEvent(string $event)
            {
                $this->events[] = $event;
            }

            public function clearEvents()
            {
                $this->events = [];
            }

            public function showSimpleNotification(): void
            {
                $this->notification()->success(
                    $title       = 'Success title',
                    $description = 'Success description',
                );
            }

            public function showConfirmActionWithSingleCallback(): void
            {
                $this->notification()->confirm([
                    'title'       => 'Confirmation Notification',
                    'description' => 'You need confirm it',
                    'acceptLabel' => 'Confirm it',
                    'method'      => 'setValue',
                    'params'      => 'Confirmed',
                ]);
            }

            public function showConfirmActionWithMultipleCallbacksAndEvents()
            {
                $this->notification()->confirm([
                    'title'       => 'Confirm It Jetete',
                    'description' => 'Description can be null like title',
                    'timeout'     => 300,
                    'accept'      => [
                        'label'  => 'Accept',
                        'method' => 'setValue',
                        'params' => 'Jetete',
                    ],
                    'reject' => [
                        'label'  => 'Reject',
                        'method' => 'setValue',
                        'params' => 'Xablaw',
                    ],
                    'onClose' => [
                        'method' => 'addEvent',
                        'params' => 'onClose',
                    ],
                    'onDismiss' => [
                        'method' => 'addEvent',
                        'params' => 'onDismiss',
                    ],
                    'onTimeout' => [
                        'method' => 'addEvent',
                        'params' => 'onTimeout',
                    ],
                ]);
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>notifications test</h1>

                    <span dusk="value">{{ $value }}</span>
                    <span dusk="events">{{ implode(',', $events) }}</span>

                    <button
                        dusk="button.test.directive"
                        type="button"
                        @confirmAction({
                            title: 'Confirm Action',
                            accept: {
                                label: 'Confirm Directive',
                                method: 'setValue',
                                params: 'Accepted'
                            },
                            reject: {
                                label: 'Cancel Directive',
                                method: 'setValue',
                                params: 'Rejected'
                            }
                        })>
                        Confirm action dialog
                    </button>

                    <button
                        dusk="button.test.simple_notification"
                        wire:click="showSimpleNotification">
                        Show Success Notification
                    </button>

                    <button
                        dusk="button.test.call_confirm_action_with_single_callback"
                        wire:click="showConfirmActionWithSingleCallback">
                        Call Confirm Action with single callback
                    </button>

                    <button
                        dusk="button.clear_events"
                        wire:click="clearEvents">
                        clear events
                    </button>

                    <button
                        dusk="button.test.call_confirm_action_with_multiples_callbacks_and_events"
                        wire:click="showConfirmActionWithMultipleCallbacksAndEvents">
                        Call Confirm Action with multiples callbacks and events
                    </button>

                    <button
                        dusk="button.test.js.simple_notification"
                        onclick="addSimpleNotification()">
                        Fire Simple Notification from js
                    </button>

                    <button
                        dusk="button.test.js.complex_notification"
                        onclick="firstComplexPersistentNotification()">
                        Fire Complex Notification from js
                    </button>

                    <button
                        dusk="button.test.redirect_on_close_notification"
                        onclick="showNotificationWithRedirectOnClose()">
                        Redirect on close Notification
                    </button>

                    @push('scripts')
                        <script>
                            function addSimpleNotification() {
                                window.$wireui.notify({
                                    title: 'My Simple Notification from js',
                                    icon: 'info',
                                })
                            }

                            function firstComplexPersistentNotification() {
                                window.$wireui.notify({
                                    title: 'My Complex Notification from js',
                                    description: 'Want to delete this record?',
                                    icon: 'success',
                                    iconColor: 'text-blue-900',
                                    closeButton: false,
                                    timeout: false,
                                    accept: {
                                        label: 'Delete',
                                        style: null,
                                        execute: () => @this.call('setValue', 'deleted')
                                    },
                                    reject: {
                                        label: 'No delete',
                                        style: null,
                                        execute: () => @this.call('setValue', 'delete canceled')
                                    },
                                    onClose:   () => @this.call('addEvent', 'onClose'),
                                    onDismiss: () => @this.call('addEvent', 'onDismiss'),
                                    onTimeout: () => @this.call('addEvent', 'onTimeout'),
                                })
                            }

                            function showNotificationWithRedirectOnClose() {
                                window.$wireui.notify({
                                    title: 'My Simple Notification from js',
                                    icon: 'info',
                                    onClose: {
                                        url: `${window.location.href}#redirected`
                                    }
                                })
                            }
                        </script>
                    @endpush
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_show_notification_from_directive_and_call_accept_and_reject_methods()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'Notifications.view')
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

    public function test_it_should_show_simple_notification_from_component_call()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'Notifications.view')
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

    public function test_it_should_show_confirmation_with_single_callback_from_component_call()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'Notifications.view')
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

    public function test_it_should_show_confirmation_with_multiple_callbacks_and_events_from_component_call()
    {
        $this->browse(function (Browser $browser) {
            $duskButton = '@button.test.call_confirm_action_with_multiples_callbacks_and_events';

            $this->visit($browser, 'Notifications.view')
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

    public function test_it_should_show_simple_notification_from_js_call()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'Notifications.view')
                ->click('@button.test.js.simple_notification')
                ->waitUsing(7, 100, fn () => $browser->assertSee('My Simple Notification from js'));
        });
    }

    public function test_it_should_show_complex_notification_from_js_call()
    {
        $this->browse(function (Browser $browser) {
            $duskButton = '@button.test.js.complex_notification';

            $this->visit($browser, 'Notifications.view')
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

    public function test_it_should_redirect_when_notification_is_closed()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'Notifications.view')
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
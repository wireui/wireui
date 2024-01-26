<?php

namespace WireUi\Components\Dialog\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;
use WireUi\Traits\WireUiActions;

class IndexTest extends BrowserTestCase
{
    public function browser(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            use WireUiActions;

            public array $events = [];

            protected $listeners = ['showDialog', 'addEvent'];

            public function showDialog(array $options)
            {
                $this->dialog()->show($options);
            }

            public function addEvent(string $event)
            {
                $this->events[] = $event;
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Dialog Browser Test</h1>

                    <x-dialog id="custom">
                        my slot
                    </x-dialog>

                    <span dusk="events">{{ implode(', ', $events) }}</span>
                </div>
                BLADE;
            }
        });
    }

    /**
     * @test
     *
     * @dataProvider provideAlertMessages
     */
    public function it_should_show_simple_alert_dialog_from_js(
        string $icon,
        string $title,
        string $description,
    ): void {
        $this->browser()
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.\$wireui.dialog({
                    icon: "{$icon}",
                    title: "{$title}",
                    description: "{$description}",
                })
            EOT))
            ->pause(200)
            ->assertSee($title)
            ->assertSee($description);
    }

    /**
     * @test
     *
     * @dataProvider provideAlertMessages
     */
    public function it_should_show_simple_alert_dialog_from_livewire_component(
        string $icon,
        string $title,
        string $description,
    ): void {
        $this->browser()
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.Livewire.dispatch('showDialog', { options: {
                    icon: "{$icon}",
                    title: "{$title}",
                    description: "{$description}",
                }})
            EOT))
            ->waitTo(fn (Browser $browser) => $browser->assertSee($title))
            ->assertSee($description);
    }

    /**
     * @test
     *
     * @dataProvider provideAlertMessages
     */
    public function it_should_show_custom_simple_alert_dialog(
        string $icon,
        string $title,
        string $description,
    ): void {
        $this->browser()
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.\$wireui.dialog({
                    id: 'custom',
                    icon: "{$icon}",
                    title: "{$title}",
                    description: "{$description}",
                })
            EOT))
            ->waitForText($title)
            ->assertSee($title)
            ->waitForText($description)
            ->assertSee($description);
    }

    public function test_it_should_close_when_timeout_is_end(): void
    {
        $title = 'Autoclosing...';

        $this->browser()
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.\$wireui.dialog({ title: '{$title}', timeout: 400 })
            EOT))
            ->waitForText($title)
            ->assertSee($title)
            ->waitUntilMissingText($title)
            ->assertDontSee($title);
    }

    public function test_it_should_call_callable_events_actions(): void
    {
        $this->browser()
            ->tap(fn (Browser $browser) => $this->showDialog($browser))
            ->pause(400)
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                document.querySelector('button.dialog-button-close').click()
            EOT))
            ->pause(100)
            ->assertSeeIn('@events', 'onClose, onTimeout')
            ->tap(fn (Browser $browser) => $this->showDialog($browser))
            ->pause(150)
            ->tap(fn (Browser $browser) => $browser->script("
                document.querySelector('div.dialog-backdrop').click()
            "))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@events', 'onClose, onDismiss'));
    }

    private function showDialog(Browser $browser): void
    {
        $browser->script("
            window.\$wireui.dialog({
                title: 'Testing events',
                timeout: 300,
                onClose() {
                    window.Livewire.dispatch('addEvent', { event: 'onClose' })
                },
                onTimeout() {
                    window.Livewire.dispatch('addEvent', { event: 'onTimeout' })
                },
                onDismiss() {
                    window.Livewire.dispatch('addEvent', { event: 'onDismiss' })
                },
            })
        ");
    }

    public static function provideAlertMessages(): array
    {
        return [
            [
                'icon'        => 'success',
                'title'       => 'Account Created',
                'description' => 'Your account was created',
            ],
            [
                'icon'        => 'error',
                'title'       => 'Permission Denied',
                'description' => "You don't have enough permission",
            ],
            [
                'icon'        => 'info',
                'title'       => 'Today is a good day',
                'description' => 'Wireui is very helpful',
            ],
            [
                'icon'        => 'warning',
                'title'       => 'It can be permanent',
                'description' => 'Wish delete this file?',
            ],
            [
                'icon'        => 'question',
                'title'       => 'Sure delete?',
                'description' => 'This action is irreversible',
            ],
        ];
    }

    public function test_it_should_perform_accept_and_reject_action(): void
    {
        $this->browser()
            ->tap(fn (Browser $browser) => $this->showConfirmDialog($browser))
            ->pause(200)
            ->assertSee('This is a title')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Confirm it'))
            ->assertSee('Confirm it')
            ->press('Confirm it')
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@events', 'accepted'))
            ->tap(fn (Browser $browser) => $this->showConfirmDialog($browser))
            ->pause(200)
            ->press('Decline')
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@events', 'accepted, rejected'));
    }

    public function test_it_should_prevent_twice_calls_on_accept_and_reject_action(): void
    {
        $this->browser()
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
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@events', 'accepted'));
    }

    private function showConfirmDialog(Browser $browser): void
    {
        $browser->script("
            window.\$wireui.confirmDialog({
                title: 'This is a title',
                accept: {
                    label: 'Confirm it',
                    execute() {
                        window.Livewire.dispatch('addEvent', { event: 'accepted' })
                    }
                },
                reject: {
                    label: 'Decline',
                    execute() {
                        window.Livewire.dispatch('addEvent', { event: 'rejected' })
                    }
                }
            })
        ");
    }
}

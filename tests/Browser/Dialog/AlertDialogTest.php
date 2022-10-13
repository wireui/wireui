<?php

namespace Tests\Browser\Dialog;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class AlertDialogTest extends BrowserTestCase
{
    /**
     * @test
     * @dataProvider provideAlertMessages
     */
    public function it_should_show_simple_alert_dialog_from_js(
        string $icon,
        string $title,
        string $description
    ) {
        $this->browse(function (Browser $browser) use ($icon, $title, $description) {
            $this->visit($browser, Component::class)
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
        });
    }

    /**
     * @test
     * @dataProvider provideAlertMessages
     */
    public function it_should_show_simple_alert_dialog_from_livewire_component(
        string $icon,
        string $title,
        string $description
    ) {
        $this->browse(function (Browser $browser) use ($icon, $title, $description) {
            $this->visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.livewire.emit('showDialog', {
                    icon: "{$icon}",
                    title: "{$title}",
                    description: "{$description}",
                })
                EOT))
                ->waitForLivewire()
                ->waitUsing(7, 100, fn () => $browser->assertSee($title))
                ->assertSee($description);
        });
    }

    /**
     * @test
     * @dataProvider provideAlertMessages
     */
    public function it_should_show_custom_simple_alert_dialog(
        string $icon,
        string $title,
        string $description
    ) {
        $this->browse(function (Browser $browser) use ($icon, $title, $description) {
            $this->visit($browser, Component::class)
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
        });
    }

    /** @test */
    public function it_should_close_when_timeout_is_end()
    {
        $this->browse(function (Browser $browser) {
            $title = 'Autoclosing...';

            $this->visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                    window.\$wireui.dialog({ title: '{$title}', timeout: 400 })
                EOT))
                ->waitForText($title)
                ->assertSee($title)
                ->waitUntilMissingText($title)
                ->assertDontSee($title);
        });
    }

    /** @test */
    public function it_should_call_callable_events_actions()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $this->showDialog($browser))
                ->pause(400)
                ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                    document.querySelector('button.dialog-button-close').click()
                EOT))
                ->waitForLivewire()
                ->pause(100)
                ->assertSeeIn('@events', 'onClose, onTimeout')
                ->tap(fn (Browser $browser) => $this->showDialog($browser))
                ->pause(150)
                ->tap(fn (Browser $browser) => $browser->script("
                    document.querySelector('div.dialog-backdrop').click()
                "))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@events', 'onClose, onDismiss'));
        });
    }

    private function showDialog(Browser $browser): void
    {
        $browser->script("
            window.\$wireui.dialog({
                title: 'Testing events',
                timeout: 300,
                onClose() {
                    window.livewire.emit('addEvent', 'onClose')
                },
                onTimeout() {
                    window.livewire.emit('addEvent', 'onTimeout')
                },
                onDismiss() {
                    window.livewire.emit('addEvent', 'onDismiss')
                },
            })
        ");
    }

    public function provideAlertMessages(): array
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
                'description' => "You don't have suficiente permission",
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
}

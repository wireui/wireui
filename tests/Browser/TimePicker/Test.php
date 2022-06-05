<?php

namespace Tests\Browser\TimePicker;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_select_time_and_clear_am_pm_time()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->type('timeAmPm', '144')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser
                        ->assertInputValue('timeAmPm', '1:44')
                        ->assertSeeIn('@timeAmPm', '01:44');
                })->type('timeAmPm', '1:59 PM')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser
                        ->assertInputValue('timeAmPm', '1:59 PM')
                        ->assertSeeIn('@timeAmPm', '13:59');
                })->tap(function (Browser $browser) {
                    return $browser->script('
                        const input = document.querySelector("[name=\'timeAmPm\']")
                        input.value = ""
                        input.dispatchEvent(new Event("input"))
                    ');
                })->waitUsing(7, 100, function () use ($browser) {
                    return $browser
                        ->assertInputValue('timeAmPm', '')
                        ->assertDontSeeIn('@timeAmPm', '13:59');
                });
        });
    }

    /** @test */
    public function it_should_select_time_and_clear_24h_time()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->type('time24H', '12:44')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser
                        ->assertInputValue('time24H', '12:44')
                        ->assertSeeIn('@time24H', '12:44');
                })->type('time24H', '17:59')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser
                        ->assertInputValue('time24H', '17:59')
                        ->assertSeeIn('@time24H', '17:59');
                })->tap(function (Browser $browser) {
                    return $browser->script('
                        const input = document.querySelector("[name=\'time24H\']")
                        input.value = ""
                        input.dispatchEvent(new Event("input"))
                    ');
                })->waitUsing(7, 100, function () use ($browser) {
                    return $browser
                        ->assertInputValue('time24H', '')
                        ->assertDontSeeIn('@time24H', '17:59');
                });
        });
    }

    /**
     * @test
     * @warn must use .defer if using model property as datetime, datetime cannot has empty hours
     * */
    public function it_should_select_time_using_model_property_datetime()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertInputValue('user.birthday', '11:05 PM')
                ->clear('user.birthday')
                ->typeSlowly('user.birthday', '12:45 AM', 50)
                ->assertInputValue('user.birthday', '12:45 AM')
                ->click('@refresh')
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@user.birthday', '00:45'))
                ->clear('user.birthday')
                ->type('user.birthday', '7:59 PM')
                ->click('@refresh')
                ->assertInputValue('user.birthday', '7:59 PM')
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@user.birthday', '19:59'))
                ->tap(function (Browser $browser) {
                    return $browser->script('
                        const input = document.querySelector("[name=\'user.birthday\']")
                        input.value = ""
                        input.dispatchEvent(new Event("input"))
                    ');
                })->assertInputValue('user.birthday', '');
        });
    }
}

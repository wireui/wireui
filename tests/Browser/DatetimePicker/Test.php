<?php

namespace Tests\Browser\DatetimePicker;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_select_date_without_timezone_difference()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertInputValue('withoutTimezone', '2021-05-22 02:48')
                ->click('[id="withoutTimezone"]')
                ->tap(fn () => $this->selectDate($browser, 'withoutTimezone', 5))
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@withoutTimezone', '2021-05-05T02:48:00Z'))
                ->assertInputValue('withoutTimezone', '2021-05-05 02:48');
        });
    }

    /** @test */
    public function it_should_select_date_with_utc_timezone_difference()
    {
        // The America/Sao_Paulo timezone is -3 hours apart compared to the UTC timezone
        // UTC is default timezone
        // ref https://www.zeitverschiebung.net/en/timezone/america--sao_paulo

        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertInputValue('utcTimezone', '2021-07-21 21:30')
                ->click('[id="utcTimezone"] input')
                ->tap(fn () => $this->selectDate($browser, 'utcTimezone', 31))
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@utcTimezone', '2021-08-01T00:30:00Z'))
                ->assertInputValue('utcTimezone', '2021-07-31 21:30');
        });
    }

    /** @test */
    public function it_should_select_date_with_default_timezone_and_auto_user_timezone()
    {
        // The America/Sao_Paulo timezone is +12 hours apart compared to the Asia/Tokyo timezone
        // ref https://www.zeitverschiebung.net/en/difference/city/3448439/city/1850147

        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertInputValue('tokyoTimezone', '2021-07-25 22:00')
                ->click('[id="tokyoTimezone"] input')
                ->tap(fn () => $this->selectDate($browser, 'tokyoTimezone', 31))
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@tokyoTimezone', '2021-08-01T10:00:00+09:00'))
                ->assertInputValue('tokyoTimezone', '2021-07-31 22:00');
        });
    }

    /** @test */
    public function it_should_parse_date_in_custom_format()
    {
        // The America/Sao_Paulo timezone is +12 hours apart compared to the Asia/Tokyo timezone
        // ref https://www.zeitverschiebung.net/en/difference/city/3448439/city/1850147

        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertInputValue('customFormat', '29-2021-09 59:13')
                ->click('[id="customFormat"] input')
                ->tap(fn () => $this->selectDate($browser, 'customFormat', 10))
                ->waitForLivewire()
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@customFormat', '10-2021-09 59:13'))
                ->assertInputValue('customFormat', '10-2021-09 59:13');
        });
    }

    /** @test */
    public function it_should_select_date_and_time()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertInputValue('dateAndTime', '25-12-2021 00:00')
                ->click('[id="dateAndTime"] input')
                ->tap(fn () => $this->selectDate($browser, 'dateAndTime', 11))
                ->waitForLivewire()
                ->assertInputValue('dateAndTime', '11-12-2021 00:00')
                ->assertSeeIn('@dateAndTime', '2021-12-11T00:00:00Z')
                ->pause(1000)
                ->tap(fn () => $browser->script(<<<EOT
                    console.log(document.querySelectorAll('[id="dateAndTime"] .picker-times button'));

                    [...document.querySelectorAll('[id="dateAndTime"] .picker-times button')]
                        .find(time => time.innerText.includes('5:50 AM'))
                        .click()
                EOT))
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@dateAndTime', '2021-12-11T05:50:00Z'))
                ->assertInputValue('dateAndTime', '11-12-2021 05:50');
        });
    }

    private function selectDate(Browser $browser, string $id, int $date): array
    {
        return $browser->script(<<<EOT
            [...document.querySelectorAll('[id="$id"] .picker-days button')]
                .find(day => day.innerText == $date)
                .click()
        EOT);
    }
}

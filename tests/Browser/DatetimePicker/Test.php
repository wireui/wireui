<?php

namespace Tests\Browser\DatetimePicker;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_select_date_without_timezone_difference()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'DatetimePicker.view')
                ->assertInputValue('withoutTimezone', '2021-05-22 02:48')
                ->click('[id="withoutTimezone"]')
                ->tap(fn () => $this->selectDate($browser, 'withoutTimezone', 5))
                ->waitForTextIn('@withoutTimezone', '2021-05-05T02:48:00Z')
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
            $this->visit($browser, 'DatetimePicker.view')
                ->assertInputValue('utcTimezone', '2021-07-21 21:30')
                ->click('[id="utcTimezone"] input')
                ->tap(fn () => $this->selectDate($browser, 'utcTimezone', 31))
                ->waitForTextIn('@utcTimezone', '2021-08-01T00:30:00Z')
                ->assertInputValue('utcTimezone', '2021-07-31 21:30');
        });
    }

    /** @test */
    public function it_should_select_date_with_default_timezone_and_auto_user_timezone()
    {
        // The America/Sao_Paulo timezone is +12 hours apart compared to the Asia/Tokyo timezone
        // ref https://www.zeitverschiebung.net/en/difference/city/3448439/city/1850147

        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'DatetimePicker.view')
                ->assertInputValue('tokyoTimezone', '2021-07-25 22:00')
                ->click('[id="tokyoTimezone"] input')
                ->tap(fn () => $this->selectDate($browser, 'tokyoTimezone', 31))
                ->waitForTextIn('@tokyoTimezone', '2021-08-01T10:00:00+09:00')
                ->assertInputValue('tokyoTimezone', '2021-07-31 22:00');
        });
    }

    /** @test */
    public function it_should_parse_date_in_custom_format()
    {
        // The America/Sao_Paulo timezone is +12 hours apart compared to the Asia/Tokyo timezone
        // ref https://www.zeitverschiebung.net/en/difference/city/3448439/city/1850147

        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'DatetimePicker.view')
                ->assertInputValue('customFormat', '29-2021-09 59:13')
                ->click('[id="customFormat"] input')
                ->tap(fn () => $this->selectDate($browser, 'customFormat', 10))
                ->waitForTextIn('@customFormat', '10-2021-09 59:13')
                ->assertInputValue('customFormat', '10-2021-09 59:13');
        });
    }

    /** @test */
    public function it_should_select_date_and_time()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'DatetimePicker.view')
                ->assertInputValue('dateAndTime', '25-12-2021 00:00')
                ->click('[id="dateAndTime"] input')
                ->tap(fn () => $this->selectDate($browser, 'dateAndTime', 11))
                ->tap(fn () => $browser->waitForLivewire())
                ->waitForTextIn('@dateAndTime', '2021-12-11T00:00:00Z')
                ->assertInputValue('dateAndTime', '11-12-2021 00:00')
                ->pause(1000)
                ->tap(fn () => $browser->script(<<<EOT
                    console.log(document.querySelectorAll('[id="dateAndTime"] .picker-times button'));

                    [...document.querySelectorAll('[id="dateAndTime"] .picker-times button')]
                        .find(time => time.innerText.includes('5:50 AM'))
                        .click()
                EOT))
                ->waitForTextIn('@dateAndTime', '2021-12-11T05:50:00Z')
                ->assertInputValue('dateAndTime', '11-12-2021 05:50');
        });
    }

    /**
     * @test
     *
     * @dataProvider datesProvider
     */
    public function it_should_select_only_the_dates_inside_a_range_min_and_max(bool $disabled, int $day, string $model, string $input)
    {
        $this->browse(function (Browser $browser) use ($disabled, $day, $model, $input) {
            /** @var Browser|Testable $component */
            $component = $this->visit($browser, 'DatetimePicker.view')
                ->click('[name="model"]')
                ->tap(fn () => $browser->assertScript(<<<EOT
                    [...document.querySelectorAll('.picker-days button')]
                        .find(day => day.innerText == {$day})
                        .hasAttribute('disabled')
                EOT, $disabled))
                ->tap(fn () => $this->selectDate($browser, 'minMaxLimits', $day));

            if (!$disabled) {
                $component
                    ->waitForTextIn('@value', $model)
                    ->assertInputValue('model', $input);
            }
        });
    }

    /**
     * @test
     *
     * @dataProvider timesProvider
     */
    public function it_should_select_only_times_inside_the_limit(int $day, string $time, bool $exists)
    {
        $this->browse(function (Browser $browser) use ($day, $time, $exists) {
            $this->visit($browser, 'DatetimePicker.view')
                ->click('[name="model"]')
                ->tap(fn () => $this->selectDate($browser, 'minMaxLimits', $day))
                ->waitUsing(7, 100, fn () => $browser->assertScript(
                    "!!document.querySelector('[name=\"times.{$time}\"]')",
                    $exists,
                ));
        });
    }

    public static function datesProvider(): array
    {
        return [
            ['disabled' => true,  'day' => 1,  'model' => '',                     'input' => ''],
            ['disabled' => true,  'day' => 7,  'model' => '',                     'input' => ''],
            ['disabled' => false, 'day' => 8,  'model' => '2021-12-08T10:30:00Z', 'input' => '12/8/2021, 10:30 AM'],
            ['disabled' => false, 'day' => 16, 'model' => '2021-12-16T10:30:00Z', 'input' => '12/16/2021, 10:30 AM'],
            ['disabled' => false, 'day' => 22, 'model' => '2021-12-22T10:30:00Z', 'input' => '12/22/2021, 10:30 AM'],
            ['disabled' => true,  'day' => 23, 'model' => '',                     'input' => ''],
            ['disabled' => true,  'day' => 30, 'model' => '',                     'input' => ''],
        ];
    }

    public static function timesProvider(): array
    {
        return [
            ['day' => 8,  'time' => '12:30', 'exists' => true],
            ['day' => 16, 'time' => '12:30', 'exists' => true],
            ['day' => 22, 'time' => '12:30', 'exists' => true],

            ['day' => 8,  'time' => '00:00', 'exists' => false],
            ['day' => 16, 'time' => '00:00', 'exists' => true],
            ['day' => 22, 'time' => '00:00', 'exists' => true],

            ['day' => 8,  'time' => '15:30', 'exists' => true],
            ['day' => 16, 'time' => '15:30', 'exists' => true],
            ['day' => 22, 'time' => '15:30', 'exists' => true],

            ['day' => 8,  'time' => '15:00', 'exists' => true],
            ['day' => 16, 'time' => '15:00', 'exists' => true],
            ['day' => 22, 'time' => '15:00', 'exists' => false],
        ];
    }

    private function selectDate(Browser $browser, string $id, int $day): array
    {
        return $browser->script(<<<EOT
            [...document.querySelectorAll('[id="{$id}"] .picker-days button')]
                .find(day => day.innerText == {$day})
                .click()
        EOT);
    }
}

<?php

namespace WireUi\Components\DatetimePicker\tests\Browser;

use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class PickerTest extends BrowserTestCase
{
    public function browser(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $date = null;

            public $model = '2021-12-15 10:30';

            public $dateAndTime = '2021-12-25 00:00';

            public $utcTimezone = '2021-07-22 00:30';

            public $customFormat = '29-2021-09 59:13';

            public $tokyoTimezone = '2021-07-26 10:00';

            public $withoutTimezone = '2021-05-22T02:48';

            public function mount(): void
            {
                $this->date = Carbon::parse('2021-12-15 10:30');
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Datetime Picker Browser Test</h1>

                    // test it_should_select_date_without_timezone_difference
                    <div id="withoutTimezone">
                        <x-datetime-picker
                            wire:model.live="withoutTimezone"
                            without-timezone
                            label="Without Timezone"
                            display-format="YYYY-MM-DD HH:mm"
                        />
                        <span dusk="withoutTimezone">{{ $withoutTimezone }}</span>
                    </div>

                    // test it_should_select_date_with_utc_timezone_difference
                    <div id="utcTimezone">
                        <x-datetime-picker
                            wire:model.live="utcTimezone"
                            label="UTC Timezone"
                            {{-- the user's timezone is automatic, but I need to mock the timezone in the tests --}}
                            user-timezone="America/Sao_Paulo"
                            display-format="YYYY-MM-DD HH:mm"
                        />
                        <span dusk="utcTimezone">{{ $utcTimezone }}</span>
                    </div>

                    // test it_should_select_date_with_default_timezone_and_auto_user_timezone
                    <div id="tokyoTimezone">
                        <x-datetime-picker
                            wire:model.live="tokyoTimezone"
                            timezone="Asia/Tokyo"
                            {{-- the user's timezone is automatic, but I need to mock the timezone in the tests --}}
                            user-timezone="America/Sao_Paulo"
                            label="Asia/Tokyo Timezone"
                            display-format="YYYY-MM-DD HH:mm"
                        />
                        <span dusk="tokyoTimezone">{{ $tokyoTimezone }}</span>
                    </div>

                    // test it_should_parse_date_in_custom_format
                    <div id="customFormat">
                        <x-datetime-picker
                            wire:model.live="customFormat"
                            parse-format="DD-YYYY-MM mm:HH"
                            without-timezone
                            label="Custom Format Parse"
                            display-format="DD-YYYY-MM mm:HH"
                        />
                        <span dusk="customFormat">{{ $customFormat }}</span>
                    </div>

                    // test it_should_select_date_and_time
                    <div id="dateAndTime">
                        <x-datetime-picker
                            wire:model.live="dateAndTime"
                            without-timezone
                            label="Date and Time"
                            display-format="DD-MM-YYYY HH:mm"
                        />
                        <span dusk="dateAndTime">{{ $dateAndTime }}</span>
                    </div>

                    <h1>MinMaxLimitsTest</h1>

                    <div id="minMaxLimits">
                        <x-datetime-picker
                            wire:model.live="model"
                            without-timezone
                            :min="$date->copy()->subDays(7)->setHour(12)->toISOString()"
                            :max="$date->copy()->addDays(7)->setHour(15)->toISOString()"
                        />
                        <span dusk="value">{{ $model }}</span>
                    </div>
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_select_date_without_timezone_difference(): void
    {
        Livewire::visit(new class() extends Component
        {
            public $model = '2021-05-22T02:48';

            public function render(): string
            {
                return <<<'BLADE'
                <div id="model">
                    <x-badge dusk="model" :label="$model" />

                    <x-datetime-picker
                        wire:model.live="model"
                        without-timezone
                        label="Without Timezone"
                        display-format="YYYY-MM-DD HH:mm"
                    />
                </div>
                BLADE;
            }
        })
            ->assertInputValue('model', '2021-05-22T02:48:00')
            ->clickWrapper()
            ->tap(fn (Browser $browser) => $browser->selectDate('model', 5))
            ->waitForTextIn('@model', '2021-05-05T02:48:00')
            ->assertInputValue('model', '2021-05-05T02:48:00');
    }

    public function test_it_should_select_date_with_utc_timezone_difference(): void
    {
        // The America/Sao_Paulo timezone is -3 hours apart compared to the UTC timezone
        // UTC is default timezone
        // ref https://www.zeitverschiebung.net/en/timezone/america--sao_paulo

        $this->browser()
            ->assertInputValue('utcTimezone', '2021-07-21 21:30')
            ->click('[id="utcTimezone"] input')
            ->tap(fn (Browser $browser) => $browser->selectDate('utcTimezone', 31))
            ->waitForTextIn('@utcTimezone', '2021-08-01T00:30:00Z')
            ->assertInputValue('utcTimezone', '2021-07-31 21:30');
    }

    public function test_it_should_select_date_with_default_timezone_and_auto_user_timezone(): void
    {
        // The America/Sao_Paulo timezone is +12 hours apart compared to the Asia/Tokyo timezone
        // ref https://www.zeitverschiebung.net/en/difference/city/3448439/city/1850147

        $this->browser()
            ->assertInputValue('tokyoTimezone', '2021-07-25 22:00')
            ->click('[id="tokyoTimezone"] input')
            ->tap(fn (Browser $browser) => $browser->selectDate('tokyoTimezone', 31))
            ->waitForTextIn('@tokyoTimezone', '2021-08-01T10:00:00+09:00')
            ->assertInputValue('tokyoTimezone', '2021-07-31 22:00');
    }

    public function test_it_should_parse_date_in_custom_format(): void
    {
        // The America/Sao_Paulo timezone is +12 hours apart compared to the Asia/Tokyo timezone
        // ref https://www.zeitverschiebung.net/en/difference/city/3448439/city/1850147

        $this->browser()
            ->assertInputValue('customFormat', '29-2021-09 59:13')
            ->click('[id="customFormat"] input')
            ->tap(fn (Browser $browser) => $browser->selectDate('customFormat', 10))
            ->waitForTextIn('@customFormat', '10-2021-09 59:13')
            ->assertInputValue('customFormat', '10-2021-09 59:13');
    }

    public function test_it_should_select_date_and_time(): void
    {
        $this->browser()
            ->assertInputValue('dateAndTime', '25-12-2021 00:00')
            ->click('[id="dateAndTime"] input')
            ->tap(fn (Browser $browser) => $browser->selectDate('dateAndTime', 11))
            ->tap(fn (Browser $browser) => $browser->waitForLivewire())
            ->waitForTextIn('@dateAndTime', '2021-12-11T00:00:00Z')
            ->assertInputValue('dateAndTime', '11-12-2021 00:00')
            ->pause(1000)
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                console.log(document.querySelectorAll('[id="dateAndTime"] .picker-times button'));

                [...document.querySelectorAll('[id="dateAndTime"] .picker-times button')]
                    .find(time => time.innerText.includes('5:50 AM'))
                    .click()
            JS))
            ->waitForTextIn('@dateAndTime', '2021-12-11T05:50:00Z')
            ->assertInputValue('dateAndTime', '11-12-2021 05:50');
    }

    /**
     * @test
     *
     * @dataProvider datesProvider
     */
    public function it_should_select_only_the_dates_inside_a_range_min_and_max(bool $disabled, int $day, string $model, string $input)
    {
        $browser = $this->browser()
            ->click('[name="model"]')
            ->tap(fn (Browser $browser) => $browser->assertScript(<<<EOT
                    [...document.querySelectorAll('.picker-days button')]
                        .find(day => day.innerText == {$day})
                        .hasAttribute('disabled')
                EOT, $disabled))
            ->tap(fn (Browser $browser) => $browser->selectDate('minMaxLimits', $day));

        if (!$disabled) {
            $browser
                ->waitForTextIn('@value', $model)
                ->assertInputValue('model', $input);
        }
    }

    /**
     * @test
     *
     * @dataProvider timesProvider
     */
    public function it_should_select_only_times_inside_the_limit(int $day, string $time, bool $exists)
    {
        $this->browser()
            ->click('[name="model"]')
            ->tap(fn (Browser $browser) => $browser->selectDate('minMaxLimits', $day))
            ->waitUsing(7, 100, fn (Browser $browser) => $browser->assertScript(
                "!!document.querySelector('[name=\"times.{$time}\"]')",
                $exists,
            ));
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
}

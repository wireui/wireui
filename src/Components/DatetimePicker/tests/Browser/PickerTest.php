<?php

namespace WireUi\Components\DatetimePicker\tests\Browser;

use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class PickerTest extends BrowserTestCase
{
    public function browser(): Browser
    {
        return Livewire::visit(new class extends Component
        {
            public $date = null;

            public $model = '2021-12-15T10:30:00';

            public function mount(): void
            {
                $this->date = Carbon::parse('2021-12-15 10:30');
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="model" :label="$model" />

                    <x-datetime-picker
                        wire:model.live="model"
                        label="Min Max Limits"
                        without-timezone
                        :min="$date->copy()->subDays(7)->toISOString()"
                        :max="$date->copy()->addDays(7)->toISOString()"
                    />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_select_date_without_timezone_difference(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = '2021-05-22T02:48:00';

            public function render(): string
            {
                return <<<'BLADE'
                <div>
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
            ->toggleWrapper()
            ->tap(fn (Browser $browser) => $browser->selectDate('model', 5))
            ->waitForTextIn('@model', '2021-05-05T02:48:00')
            ->assertInputValue('model', '2021-05-05T02:48:00')
            ->waitForWrapperValue('2021-05-05 02:48');
    }

    public function test_it_should_select_date_with_utc_timezone_difference(): void
    {
        // The America/Sao_Paulo timezone is -3 hours apart compared to the UTC timezone
        // UTC is default timezone
        // ref https://www.zeitverschiebung.net/en/timezone/america--sao_paulo

        Livewire::visit(new class extends Component
        {
            public $model = '2021-07-22T00:30:00';

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="model" :label="$model" />

                    <x-datetime-picker
                        wire:model.live="model"
                        label="UTC Timezone"
                        user-timezone="America/Sao_Paulo"
                        display-format="YYYY-MM-DD HH:mm"
                    />
                </div>
                BLADE;
            }
        })
            ->assertInputValue('model', '2021-07-21T21:30:00')
            ->toggleWrapper()
            ->tap(fn (Browser $browser) => $browser->selectDate('model', 31))
            ->waitForTextIn('@model', '2021-08-01T00:30:00')
            ->assertInputValue('model', '2021-07-31T21:30:00')
            ->waitForWrapperValue('2021-07-31 21:30');
    }

    public function test_it_should_select_date_with_default_timezone_and_auto_user_timezone(): void
    {
        // The America/Sao_Paulo timezone is +12 hours apart compared to the Asia/Tokyo timezone
        // ref https://www.zeitverschiebung.net/en/difference/city/3448439/city/1850147

        Livewire::visit(new class extends Component
        {
            public $model = '2021-07-26T10:00:00';

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="model" :label="$model" />

                    <x-datetime-picker
                        wire:model.live="model"
                        label="Asia/Tokyo Timezone"
                        timezone="Asia/Tokyo"
                        user-timezone="America/Sao_Paulo"
                        display-format="YYYY-MM-DD HH:mm"
                    />
                </div>
                BLADE;
            }
        })
            ->assertInputValue('model', '2021-07-25T22:00:00')
            ->toggleWrapper()
            ->tap(fn (Browser $browser) => $browser->selectDate('model', 31))
            ->waitForTextIn('@model', '2021-08-01T10:00:00')
            ->assertInputValue('model', '2021-07-31T22:00:00')
            ->waitForWrapperValue('2021-07-31 22:00');
    }

    public function test_it_should_parse_date_in_custom_format(): void
    {
        // The America/Sao_Paulo timezone is +12 hours apart compared to the Asia/Tokyo timezone
        // ref https://www.zeitverschiebung.net/en/difference/city/3448439/city/1850147

        Livewire::visit(new class extends Component
        {
            public $model = '29-2021-09 59:13';

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="model" :label="$model" />

                    <x-datetime-picker
                        wire:model.live="model"
                        label="Without Timezone"
                        without-timezone
                        parse-format="DD-YYYY-MM mm:HH"
                        display-format="DD-YYYY-MM mm:HH"
                    />
                </div>
                BLADE;
            }
        })
            ->assertInputValue('model', '29-2021-09 59:13')
            ->toggleWrapper()
            ->tap(fn (Browser $browser) => $browser->selectDate('model', 10))
            ->waitForTextIn('@model', '10-2021-09 59:13')
            ->assertInputValue('model', '10-2021-09 59:13')
            ->waitForWrapperValue('10-2021-09 59:13');
    }

    public function test_it_should_select_date_and_time(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = '2021-12-25T00:00:00';

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="model" :label="$model" />

                    <x-datetime-picker
                        wire:model.live="model"
                        label="Date and Time"
                        without-timezone
                        display-format="DD-MM-YYYY HH:mm"
                    />
                </div>
                BLADE;
            }
        })
            ->assertInputValue('model', '2021-12-25T00:00:00')
            ->toggleWrapper()
            ->tap(fn (Browser $browser) => $browser->selectDate('model', 11))
            ->waitForTextIn('@model', '2021-12-11T00:00:00')
            ->downTimePicker('hours', 4)
            ->downTimePicker('minutes', 16)
            ->downTimePicker('seconds', 21)
            ->assertInputValue('model', '2021-12-11T08:44:39')
            ->downTimePicker('period', 1)
            ->assertInputValue('model', '2021-12-11T20:44:39')
            ->toggleWrapper()
            ->waitForWrapperValue('11-12-2021 20:44');
    }

    /**
     * @test
     *
     * @dataProvider datesProvider
     */
    public function it_should_select_only_the_dates_inside_a_range_min_and_max(int $day, string $model)
    {
        $this->browser()
            ->toggleWrapper()
            ->tap(fn (Browser $browser) => $browser->selectDate('model', $day))
            ->waitForTextIn('@model', $model)
            ->assertInputValue('model', $model);
    }

    public static function datesProvider(): array
    {
        return [
            ['day' => 1,  'model' => '2021-12-15T10:30:00'], // Doesn't change
            ['day' => 7,  'model' => '2021-12-15T10:30:00'], // Doesn't change
            ['day' => 8,  'model' => '2021-12-08T10:30:00'],
            ['day' => 16, 'model' => '2021-12-16T10:30:00'],
            ['day' => 22, 'model' => '2021-12-22T10:30:00'],
            ['day' => 23, 'model' => '2021-12-15T10:30:00'], // Doesn't change
            ['day' => 30, 'model' => '2021-12-15T10:30:00'], // Doesn't change
        ];
    }
}

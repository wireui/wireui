<?php

namespace WireUi\Components\TimePicker\tests\Browser;

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
            public $birthday = null;

            public $time24H = null;

            public $timeAmPm = null;

            protected $rules = [
                'birthday' => 'required|datetime',
            ];

            public function mount($value)
            {
                $this->birthday = Carbon::parse('2021-05-01T23:05:51');
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Time Picker Browser Test</h1>

                    // test it_should_select_time_and_clear_am_pm_time
                    <x-time-picker placeholder="12:00 AM" wire:model.live="timeAmPm" label="Time AM/PM" />
                    <span dusk="timeAmPm">{{ $timeAmPm }}</span>

                    // test it_should_select_time_and_clear_24h_time
                    <x-time-picker format="24" placeholder="12:00" wire:model.live="time24H" label="Time 24H" />
                    <span dusk="time24H">{{ $time24H }}</span>

                    // test it_should_select_time_using_model_property_datetime
                    <button dusk="refresh" wire:click="$refresh">$refresh</button>
                    <x-time-picker placeholder="12:00" wire:model="birthday" label="Model Property" />
                    <span dusk="birthday">{{ $birthday->format('H:i') }}</span>
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_select_time_and_clear_am_pm_time(): void
    {
        $this->browser()
            ->type('timeAmPm', '144')
            ->waitTo(function (Browser $browser) {
                return $browser
                    ->assertInputValue('timeAmPm', '1:44')
                    ->assertSeeIn('@timeAmPm', '01:44');
            })->type('timeAmPm', '1:59 PM')
            ->waitTo(function (Browser $browser) {
                return $browser
                    ->assertInputValue('timeAmPm', '1:59 PM')
                    ->assertSeeIn('@timeAmPm', '13:59');
            })->tap(function (Browser $browser) {
                return $browser->script('
                    const input = document.querySelector("[name=\'timeAmPm\']")
                    input.value = ""
                    input.dispatchEvent(new Event("input"))
                ');
            })->waitTo(function (Browser $browser) {
                return $browser
                    ->assertInputValue('timeAmPm', '')
                    ->assertDontSeeIn('@timeAmPm', '13:59');
            });
    }

    public function test_it_should_select_time_and_clear_24h_time(): void
    {
        $this->browser()
            ->type('time24H', '12:44')
            ->waitTo(function (Browser $browser) {
                return $browser
                    ->assertInputValue('time24H', '12:44')
                    ->assertSeeIn('@time24H', '12:44');
            })->type('time24H', '17:59')
            ->waitTo(function (Browser $browser) {
                return $browser
                    ->assertInputValue('time24H', '17:59')
                    ->assertSeeIn('@time24H', '17:59');
            })->tap(function (Browser $browser) {
                return $browser->script('
                    const input = document.querySelector("[name=\'time24H\']")
                    input.value = ""
                    input.dispatchEvent(new Event("input"))
                ');
            })->waitTo(function (Browser $browser) {
                return $browser
                    ->assertInputValue('time24H', '')
                    ->assertDontSeeIn('@time24H', '17:59');
            });
    }

    /**
     * @test
     *
     * @warn can't use .live if using model property as datetime, datetime cannot has empty hours
     * */
    public function it_should_select_time_using_model_property_datetime(): void
    {
        $this->browser()
            ->assertInputValue('birthday', '11:05 PM')
            ->clear('birthday')
            ->typeSlowly('birthday', '12:45 AM', 50)
            ->assertInputValue('birthday', '12:45 AM')
            ->click('@refresh')
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@birthday', '00:45'))
            ->clear('birthday')
            ->type('birthday', '7:59 PM')
            ->click('@refresh')
            ->assertInputValue('birthday', '7:59 PM')
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@birthday', '19:59'))
            ->tap(function (Browser $browser) {
                return $browser->script('
                    const input = document.querySelector("[name=\'birthday\']")
                    input.value = ""
                    input.dispatchEvent(new Event("input"))
                ');
            })->assertInputValue('birthday', '');
    }
}

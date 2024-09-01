<?php

namespace WireUi\Components\TimePicker\tests\Browser;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class PickerTest extends BrowserTestCase
{
    public function test_it_should_select_time_and_clear_am_pm_time(): void
    {
        Livewire::visit(new class extends Component
        {
            public $time = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$time" />

                    <x-time-picker
                        wire:model.live="time"
                        label="Time AM/PM"
                        placeholder="12:00 AM"
                    />
                </div>
                BLADE;
            }
        })
            ->toggleAppend()
            ->downTimePicker('hours', 5)
            ->downTimePicker('minutes', 5)
            ->downTimePicker('period', 1)
            ->waitForWrapperValue('7:55:00 PM')
            ->waitForTextIn('@value', '19:55:00')
            ->downTimePicker('hours', 3)
            ->downTimePicker('minutes', 3)
            ->downTimePicker('seconds', 27)
            ->downTimePicker('period', 1)
            ->waitForWrapperValue('4:52:33 AM')
            ->waitForTextIn('@value', '04:52:33');
    }

    public function test_it_should_select_time_and_clear_24h_time(): void
    {
        Livewire::visit(new class extends Component
        {
            public $time = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$time" />

                    <x-time-picker
                        wire:model.live="time"
                        label="Time 24H"
                        placeholder="24:00"
                        military-time
                    />
                </div>
                BLADE;
            }
        })
            ->toggleAppend()
            ->downTimePicker('hours', 5)
            ->downTimePicker('minutes', 5)
            ->downTimePicker('seconds', 27)
            ->waitForWrapperValue('19:55:33')
            ->waitForTextIn('@value', '19:55:33')
            ->downTimePicker('hours', 6)
            ->downTimePicker('minutes', 3)
            ->downTimePicker('seconds', 27)
            ->waitForWrapperValue('13:52:06')
            ->waitForTextIn('@value', '13:52:06');
    }

    public function test_it_should_not_emit_seconds_when_using_without_seconds_on_a_m_p_m_time(): void
    {
        Livewire::visit(new class extends Component
        {
            public ?string $time = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$time" />

                    <x-time-picker
                        wire:model.live="time"
                        label="Time AM/PM"
                        placeholder="12:00 AM"
                        without-seconds
                    />
                </div>
                BLADE;
            }
        })
            ->toggleAppend()
            ->downTimePicker('hours', 5)
            ->downTimePicker('minutes', 5)
            ->downTimePicker('period', 1)
            ->waitForWrapperValue('7:55 PM')
            ->waitForTextIn('@value', '19:55')
            ->downTimePicker('hours', 3)
            ->downTimePicker('minutes', 3)
            ->downTimePicker('period', 1)
            ->waitForWrapperValue('4:52 AM')
            ->waitForTextIn('@value', '04:52');
    }

    public function test_it_should_not_emit_seconds_when_using_without_seconds_on_military_time(): void
    {
        Livewire::visit(new class extends Component
        {
            public $time = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$time" />

                    <x-time-picker
                        wire:model.live="time"
                        label="Time 24H"
                        placeholder="24:00"
                        military-time
                        without-seconds
                    />
                </div>
                BLADE;
            }
        })
            ->toggleAppend()
            ->downTimePicker('hours', 5)
            ->downTimePicker('minutes', 5)
            ->downTimePicker('seconds', 27)
            ->waitForWrapperValue('19:55')
            ->waitForTextIn('@value', '19:55')
            ->assertSeeIn('@value', '19:55');
    }
}

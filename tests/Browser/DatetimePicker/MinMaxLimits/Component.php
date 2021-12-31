<?php

namespace Tests\Browser\DatetimePicker\MinMaxLimits;

use Carbon\Carbon;
use Livewire;

class Component extends Livewire\Component
{
    public ?string $model = '2021-12-15 10:30';

    public function render()
    {
        $date = Carbon::parse('2021-12-15 10:30');

        return <<<HTML
            <div>
                <span dusk="value">{{ \$model }}</span>

                <x-datetime-picker
                    wire:model="model"
                    without-timezone
                    min="{$date->copy()->subDays(7)->setHour(12)->toISOString()}"
                    max="{$date->copy()->addDays(7)->setHour(15)->toISOString()}"
                />
            </div>
        HTML;
    }
}

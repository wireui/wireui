<?php

namespace Tests\Browser\DatetimePicker\MinMaxLimits;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Livewire;

class Component extends Livewire\Component
{
    public Carbon $date;

    public ?string $model = '2021-12-15 10:30';

    public function mount(): void
    {
        $this->date = Carbon::parse('2021-12-15 10:30');
    }

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}

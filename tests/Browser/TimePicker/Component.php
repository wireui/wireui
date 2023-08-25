<?php

namespace Tests\Browser\TimePicker;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public Carbon $birthday;

    public ?string $time24H = null;

    public ?string $timeAmPm = null;

    protected array $rules = ['birthday' => 'required|datetime'];

    public function mount()
    {
        $this->birthday = Carbon::parse('2021-05-01T23:05:51');
    }

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}

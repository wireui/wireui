<?php

namespace Tests\Browser\ColorPicker;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public ?string $color = '#001';

    public function render()
    {
        return View::file(__DIR__.'/view.blade.php');
    }
}

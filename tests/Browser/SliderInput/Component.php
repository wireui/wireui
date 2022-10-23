<?php

namespace Tests\Browser\SliderInput;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}

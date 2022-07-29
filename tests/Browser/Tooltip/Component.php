<?php

namespace Tests\Browser\Tooltip;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}

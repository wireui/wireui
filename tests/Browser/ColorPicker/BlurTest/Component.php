<?php

namespace Tests\Browser\ColorPicker\BlurTest;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public ?string $color = '#00000';

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}

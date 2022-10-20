<?php

namespace Tests\Browser\Badge;

use Illuminate\Support\Facades\View;

class BadgeComponent extends \Livewire\Component
{
    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}

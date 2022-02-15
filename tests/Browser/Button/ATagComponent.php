<?php

namespace Tests\Browser\Button;

use Illuminate\Support\Facades\View;

class ATagComponent extends \Livewire\Component
{
    public function render()
    {
        return View::file(__DIR__ . '/view-a-tag.blade.php');
    }
}

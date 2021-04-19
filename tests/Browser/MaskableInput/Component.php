<?php

namespace Tests\Browser\MaskableInput;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public $singleMask = 1234;

    public $singleFormattedMask = null;

    public $multipleMask = null;

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}

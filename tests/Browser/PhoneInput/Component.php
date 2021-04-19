<?php

namespace Tests\Browser\PhoneInput;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public $phone = null;

    public $customPhone = null;

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}

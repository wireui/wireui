<?php

namespace Tests\Browser\CurrencyInput;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public $currency = null;

    public $formattedCurrency = null;

    public $brazilCurrency = '123.456,99';

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }

    public function changeCurrency(): void
    {
        $this->currency = 12345.67;
    }
}

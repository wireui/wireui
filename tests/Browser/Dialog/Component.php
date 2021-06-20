<?php

namespace Tests\Browser\Dialog;

use Illuminate\Support\Facades\View;
use WireUi\Traits\Actions;

class Component extends \Livewire\Component
{
    use Actions;

    public array $events = [];

    protected $listeners = ['showDialog', 'addEvent'];

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }

    public function showDialog(array $options): void
    {
        $this->dialog()->show($options);
    }

    public function addEvent(string $event): void
    {
        $this->events[] = $event;
    }
}

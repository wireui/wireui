<?php

namespace Tests\Browser\Dialog;

use Illuminate\Support\Facades\View;
use Livewire\Attributes\On;
use WireUi\Traits\Actions;

class Component extends \Livewire\Component
{
    use Actions;

    public array $events = [];

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }

    #[On('showDialog')]
    public function showDialog(array $options): void
    {
        $this->dialog()->show($options);
    }

    #[On('addEvent')]
    public function addEvent(string $event): void
    {
        $this->events[] = $event;
    }
}

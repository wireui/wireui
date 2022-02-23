<?php

namespace Tests\Browser\Notifications;

use Illuminate\Support\Facades\View;
use WireUi\Traits\Actions;

class Component extends \Livewire\Component
{
    use Actions;

    public $value = null;

    public array $events = [];

    protected $listeners = ['setValue', 'addEvent'];

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }

    public function setValue($anyValue): void
    {
        $this->value = $anyValue;
    }

    public function addEvent(string $event)
    {
        $this->events[] = $event;
    }

    public function clearEvents()
    {
        $this->events = [];
    }

    public function showSimpleNotification(): void
    {
        $this->notification()->success(
            $title = 'Success title',
            $description = 'Success description',
        );
    }

    public function showConfirmActionWithSingleCallback(): void
    {
        $this->notification()->confirm([
            'title'       => 'Confirmation Notification',
            'description' => 'You need confirm it',
            'acceptLabel' => 'Confirm it',
            'method'      => 'setValue',
            'params'      => 'Confirmed',
        ]);
    }

    public function showConfirmActionWithMultipleCallbacksAndEvents()
    {
        $this->notification()->confirm([
            'title'       => 'Confirm It Jetete',
            'description' => 'Description can be null like title',
            'timeout'     => 300,
            'accept'      => [
                'label'  => 'Accept',
                'method' => 'setValue',
                'params' => 'Jetete',
            ],
            'reject' => [
                'label'  => 'Reject',
                'method' => 'setValue',
                'params' => 'Xablaw',
            ],
            'onClose' => [
                'method' => 'addEvent',
                'params' => 'onClose',
            ],
            'onDismiss' => [
                'method' => 'addEvent',
                'params' => 'onDismiss',
            ],
            'onTimeout' => [
                'method' => 'addEvent',
                'params' => 'onTimeout',
            ],
        ]);
    }
}

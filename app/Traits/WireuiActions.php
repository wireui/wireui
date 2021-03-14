<?php

namespace WireUi\App\Traits;

use Livewire\ComponentConcerns\ReceivesEvents;

trait WireuiActions
{
    use ReceivesEvents;

    public function notify(array $options): void
    {
        $this->dispatchBrowserEvent('wireui:notification', $options);
    }

    public function successNotification(array $options): void
    {
        $options['icon'] = 'success';

        $this->notify($options);
    }

    public function errorNotification(array $options): void
    {
        $options['icon'] = 'error';

        $this->notify($options);
    }

    public function confirmNotify(array $options): void
    {
        $options['icon'] ??= 'question';

        $this->dispatchBrowserEvent('wireui:confirmation', [
            'options'     => $options,
            'componentId' => $this->id,
        ]);
    }
}

<?php

namespace WireUi\Traits;

trait Actions
{
    public function notify(array $options): void
    {
        $this->dispatchBrowserEvent('wireui:notification', [
            'options'     => $options,
            'componentId' => $this->id,
        ]);
    }

    public function confirmNotification(array $options): void
    {
        $this->dispatchBrowserEvent('wireui:confirm-notification', [
            'options'     => $options,
            'componentId' => $this->id,
        ]);
    }

    public function successNotification(string $title, ?string $description = null): void
    {
        $options = [
            'icon'        => 'success',
            'title'       => $title,
            'description' => $description,
        ];

        $this->notify($options);
    }

    public function errorNotification(string $title, ?string $description = null): void
    {
        $options = [
            'icon'        => 'error',
            'title'       => $title,
            'description' => $description,
        ];

        $this->notify($options);
    }

    public function confirmAction(array $options): void
    {
        $options['icon'] ??= 'question';

        $this->confirmNotification($options);
    }
}

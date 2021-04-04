<?php

namespace WireUi\Traits;

trait Actions
{
    public function notify(array $options): void
    {
        $this->dispatchBrowserEvent('wireui:notification', $options);
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
            'icon'        => 'success',
            'title'       => $title,
            'description' => $description,
        ];

        $this->notify($options);
    }

    public function confirmAction(array $options): void
    {
        $options['icon'] ??= 'question';

        $this->dispatchBrowserEvent('wireui:confirmation', [
            'options'     => $options,
            'componentId' => $this->id,
        ]);
    }
}

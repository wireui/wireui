<?php

namespace WireUi\Actions;

use Livewire\Component;
use WireUi\Enum\Actions;

class Notification
{
    /**
     * Livewire component instance.
     */
    private Component $component;

    /**
     * Create a new Notification instance.
     */
    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    /**
     * Show a simple success notification.
     */
    public function success(string $title, ?string $description = null): void
    {
        $this->simpleNotification(Actions::SUCCESS->value, $title, $description);
    }

    /**
     * Show a simple error notification.
     */
    public function error(string $title, ?string $description = null): void
    {
        $this->simpleNotification(Actions::ERROR->value, $title, $description);
    }

    /**
     * Show a simple info notification.
     */
    public function info(string $title, ?string $description = null): void
    {
        $this->simpleNotification(Actions::INFO->value, $title, $description);
    }

    /**
     * Show a simple warning notification.
     */
    public function warning(string $title, ?string $description = null): void
    {
        $this->simpleNotification(Actions::WARNING->value, $title, $description);
    }

    /**
     * Show a simple question notification.
     */
    public function simpleNotification(string $icon, string $title, ?string $description = null): void
    {
        $this->send([
            'icon'        => $icon,
            'title'       => $title,
            'description' => $description,
        ]);
    }

    /**
     * Show a generic notification.
     */
    public function send(array $options): void
    {
        $this->component->dispatchBrowserEvent('wireui:notification', [
            'options'     => $options,
            'componentId' => $this->component->id,
        ]);
    }

    /**
     * Show a confirm notification.
     */
    public function confirm(array $options): void
    {
        $options['icon'] ??= Actions::QUESTION->value;

        $this->component->dispatchBrowserEvent('wireui:confirm-notification', [
            'options'     => $options,
            'componentId' => $this->component->id,
        ]);
    }
}

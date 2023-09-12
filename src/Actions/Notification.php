<?php

namespace WireUi\Actions;

use Livewire\Component;
use WireUi\Enum\Actions;

class Notification
{
    private Component $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function success(string $title, string $description = null): void
    {
        $this->simpleNotification(Actions::SUCCESS->value, $title, $description);
    }

    public function error(string $title, string $description = null): void
    {
        $this->simpleNotification(Actions::ERROR->value, $title, $description);
    }

    public function info(string $title, string $description = null): void
    {
        $this->simpleNotification(Actions::INFO->value, $title, $description);
    }

    public function warning(string $title, string $description = null): void
    {
        $this->simpleNotification(Actions::WARNING->value, $title, $description);
    }

    public function simpleNotification(string $icon, string $title, string $description = null): void
    {
        $this->send([
            'icon'        => $icon,
            'title'       => $title,
            'description' => $description,
        ]);
    }

    public function send(array $options): void
    {
        $this->component->dispatch('wireui:notification', [
            'options'     => $options,
            'componentId' => $this->component->getId(),
        ]);
    }

    public function confirm(array $options): void
    {
        $options['icon'] ??= Actions::QUESTION->value;

        $this->component->dispatch('wireui:confirm-notification', [
            'options'     => $options,
            'componentId' => $this->component->getId(),
        ]);
    }
}

<?php

namespace WireUi\Actions;

use Livewire\Component;
use WireUi\Enum\Icon;

class Notification
{
    private Component $component;

    private bool $session = false;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function session(): self
    {
        $this->session = true;

        return $this;
    }

    public function success(string $title, ?string $description = null): void
    {
        $this->simpleNotification(Icon::SUCCESS, $title, $description);
    }

    public function error(string $title, ?string $description = null): void
    {
        $this->simpleNotification(Icon::ERROR, $title, $description);
    }

    public function info(string $title, ?string $description = null): void
    {
        $this->simpleNotification(Icon::INFO, $title, $description);
    }

    public function warning(string $title, ?string $description = null): void
    {
        $this->simpleNotification(Icon::WARNING, $title, $description);
    }

    public function simpleNotification(string $icon, string $title, ?string $description = null): void
    {
        $this->send(['icon' => $icon, 'title' => $title, 'description' => $description]);
    }

    public function send(array $options): void
    {
        $this->dispatchNotification('wireui:notification', $options);
    }

    public function confirm(array $options): void
    {
        $options['icon'] ??= Icon::QUESTION;

        $this->dispatchNotification('wireui:confirm-notification', $options);
    }

    private function dispatchNotification(string $event, array $options): void
    {
        $payload = ['options' => $options, 'componentId' => $this->component->getId()];

        $this->session ? session()->flash($event, $payload) : $this->component->dispatch($event, $payload);
    }
}

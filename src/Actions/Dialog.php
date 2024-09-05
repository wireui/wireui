<?php

namespace WireUi\Actions;

use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Enum\Icon;

class Dialog
{
    private Component $component;

    private ?string $dialogId = null;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function id(string $dialogId): self
    {
        $this->dialogId = $dialogId;

        return $this;
    }

    private function getEventName(): string
    {
        return static::makeEventName($this->dialogId);
    }

    public static function makeEventName(?string $dialogId = null): string
    {
        $id = Str::kebab($dialogId ?? '');

        return ! empty($id) ? "dialog:{$id}" : 'dialog';
    }

    public function success(string $title, ?string $description = null): void
    {
        $this->simpleDialog(Icon::SUCCESS, $title, $description);
    }

    public function error(string $title, ?string $description = null): void
    {
        $this->simpleDialog(Icon::ERROR, $title, $description);
    }

    public function info(string $title, ?string $description = null): void
    {
        $this->simpleDialog(Icon::INFO, $title, $description);
    }

    public function warning(string $title, ?string $description = null): void
    {
        $this->simpleDialog(Icon::WARNING, $title, $description);
    }

    public function simpleDialog(string $icon, string $title, ?string $description = null): void
    {
        $this->show(['icon' => $icon, 'title' => $title, 'description' => $description]);
    }

    public function show(array $options): void
    {
        $options['icon'] ??= Icon::INFO;

        $this->dispatchDialog("wireui:{$this->getEventName()}", $options);
    }

    public function confirm(array $options): void
    {
        $options['icon'] ??= Icon::QUESTION;

        $this->dispatchDialog("wireui:confirm-{$this->getEventName()}", $options);
    }

    private function dispatchDialog(string $event, array $options): void
    {
        $this->component->dispatch($event, [
            'options' => $options,
            'componentId' => $this->component->getId(),
        ]);
    }
}

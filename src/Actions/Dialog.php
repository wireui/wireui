<?php

namespace WireUi\Actions;

use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Enum\Actions;

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

    public static function makeEventName(string $dialogId = null): string
    {
        $id = Str::kebab($dialogId);

        return !empty($id) ? "dialog:{$id}" : 'dialog';
    }

    public function success(string $title, string $description = null): void
    {
        $this->simpleDialog(Actions::SUCCESS->value, $title, $description);
    }

    public function error(string $title, string $description = null): void
    {
        $this->simpleDialog(Actions::ERROR->value, $title, $description);
    }

    public function info(string $title, string $description = null): void
    {
        $this->simpleDialog(Actions::INFO->value, $title, $description);
    }

    public function warning(string $title, string $description = null): void
    {
        $this->simpleDialog(Actions::WARNING->value, $title, $description);
    }

    public function simpleDialog(string $icon, string $title, string $description = null): void
    {
        $this->show(['icon' => $icon, 'title' => $title, 'description' => $description]);
    }

    public function show(array $options): void
    {
        $options['icon'] ??= Actions::INFO->value;

        $this->dispatchDialog("wireui:{$this->getEventName()}", $options);
    }

    public function confirm(array $options): void
    {
        $options['icon'] ??= Actions::QUESTION->value;

        $this->dispatchDialog("wireui:confirm-{$this->getEventName()}", $options);
    }

    private function dispatchDialog(string $event, array $options): void
    {
        $this->component->dispatch($event, [
            'options'     => $options,
            'componentId' => $this->component->getId(),
        ]);
    }
}

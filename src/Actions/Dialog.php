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
        $this->simpleDialog(Actions::SUCCESS, $title, $description);
    }

    public function error(string $title, string $description = null): void
    {
        $this->simpleDialog(Actions::ERROR, $title, $description);
    }

    public function info(string $title, string $description = null): void
    {
        $this->simpleDialog(Actions::INFO, $title, $description);
    }

    public function warning(string $title, string $description = null): void
    {
        $this->simpleDialog(Actions::WARNING, $title, $description);
    }

    public function simpleDialog(string $icon, string $title, string $description = null): void
    {
        $this->show([
            'icon'        => $icon,
            'title'       => $title,
            'description' => $description,
        ]);
    }

    public function show(array $options): void
    {
        $options['icon'] ??= Actions::INFO;

        $this->component->dispatch("wireui:{$this->getEventName()}", [
            'options'     => $options,
            'componentId' => $this->component->getId(),
        ]);
    }

    public function confirm(array $options): void
    {
        $options['icon'] ??= Actions::QUESTION;

        $this->component->dispatch("wireui:confirm-{$this->getEventName()}", [
            'options'     => $options,
            'componentId' => $this->component->getId(),
        ]);
    }
}

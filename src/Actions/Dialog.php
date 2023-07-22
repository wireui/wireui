<?php

namespace WireUi\Actions;

use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Enum\Actions;

class Dialog
{
    /**
     * Livewire component instance.
     */
    private Component $component;

    /**
     * Dialog ID.
     */
    private ?string $dialogId = null;

    /**
     * Create a new Dialog instance.
     */
    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    /**
     * Set the dialog ID.
     */
    public function id(string $dialogId): self
    {
        $this->dialogId = $dialogId;

        return $this;
    }

    /**
     * Get the dialog event name.
     */
    private function getEventName(): string
    {
        return static::makeEventName($this->dialogId);
    }

    /**
     * Make the dialog event name.
     */
    public static function makeEventName(?string $dialogId = null): string
    {
        $id = Str::kebab($dialogId);

        return ! empty($id) ? "dialog:{$id}" : 'dialog';
    }

    /**
     * Show a simple success dialog.
     */
    public function success(string $title, ?string $description = null): void
    {
        $this->simpleDialog(Actions::SUCCESS->value, $title, $description);
    }

    /**
     * Show a simple error dialog.
     */
    public function error(string $title, ?string $description = null): void
    {
        $this->simpleDialog(Actions::ERROR->value, $title, $description);
    }

    /**
     * Show a simple info dialog.
     */
    public function info(string $title, ?string $description = null): void
    {
        $this->simpleDialog(Actions::INFO->value, $title, $description);
    }

    /**
     * Show a simple warning dialog.
     */
    public function warning(string $title, ?string $description = null): void
    {
        $this->simpleDialog(Actions::WARNING->value, $title, $description);
    }

    /**
     * Show a simple dialog.
     */
    public function simpleDialog(string $icon, string $title, ?string $description = null): void
    {
        $this->show([
            'icon' => $icon,
            'title' => $title,
            'description' => $description,
        ]);
    }

    /**
     * Show a generic dialog.
     */
    public function show(array $options): void
    {
        $options['icon'] ??= Actions::INFO->value;

        $this->component->dispatchBrowserEvent("wireui:{$this->getEventName()}", [
            'options' => $options,
            'componentId' => $this->component->id,
        ]);
    }

    /**
     * Show a confirm dialog.
     */
    public function confirm(array $options): void
    {
        $options['icon'] ??= Actions::QUESTION->value;

        $this->component->dispatchBrowserEvent("wireui:confirm-{$this->getEventName()}", [
            'options' => $options,
            'componentId' => $this->component->id,
        ]);
    }
}

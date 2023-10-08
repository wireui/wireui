<?php

namespace WireUi\Actions;

use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Enum\Icon;
use WireUi\Support\DialogEvent;

/**
 * @property Component|null $component
 */
class Dialog
{
    /** @var DialogEvent[] */
    public static array $dispatches = [];

    public function __construct(
        private $component = null,
        private ?string $dialogId = 'default',
    ) {
    }

    public static function makeEventName(?string $id): string
    {
        return "dialog:{$id}";
    }

    public function id(string $dialogId): self
    {
        $this->dialogId = Str::kebab($dialogId);

        return $this;
    }

    public function show(...$options): self
    {
        $options['icon'] ??= Icon::INFO->value;

        return $this->dispatch("wireui:dialog:{$this->dialogId}", [
            'options'     => $options,
            'componentId' => $this->component?->getId(),
        ]);
    }

    public function confirm(...$options): self
    {
        $options['icon'] ??= Icon::QUESTION->value;

        return $this->dispatch("wireui:confirm-dialog:{$this->dialogId}", [
            'options'     => $options,
            'componentId' => $this->component?->getId(),
        ]);
    }

    private function dispatch(string $event, array $data): self
    {
        $this->component
            ? $this->component->dispatch($event, $data)
            : static::$dispatches[] = new DialogEvent($this->dialogId, $event, $data);

        return $this;
    }
}

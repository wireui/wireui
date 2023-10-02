<?php

namespace WireUi\Actions;

use WireUi\Enum\Icon;
use WireUi\Support\Event;

/**
 * @property \Livewire\Component|null $component
 */
class Notification
{
    /** @var Event[] */
    public static array $dispatches = [];

    public function __construct(private $component = null)
    {
    }

    public function send(...$options): self
    {
        return $this->dispatch('wireui:notification', [
            'options'     => $options,
            'componentId' => $this->component?->getId(),
        ]);
    }

    public function confirm(...$options): self
    {
        $options['icon'] ??= Icon::QUESTION->value;

        return $this->dispatch('wireui:confirm-notification', [
            'options'     => $options,
            'componentId' => $this->component?->getId(),
        ]);
    }

    private function dispatch(string $event, array $data): self
    {
        $this->component
            ? $this->component->dispatch($event, $data)
            : static::$dispatches[] = new Event($event, $data);

        return $this;
    }
}

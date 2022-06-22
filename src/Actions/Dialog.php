<?php

namespace WireUi\Actions;

use Illuminate\Support\Str;

class Dialog extends Actionable
{
    private ?string $dialogId = null;

    public static function makeEventName(?string $dialogId = null): string
    {
        $event = 'dialog';

        if ($dialogId && $id = Str::kebab($dialogId)) {
            return "{$event}:{$id}";
        }

        return $event;
    }

    public function id(?string $dialogId = null): self
    {
        $this->dialogId = $dialogId;

        return $this;
    }

    private function getEventName(): string
    {
        return static::makeEventName($this->dialogId);
    }

    public function show(array $options): self
    {
        $options['icon'] ??= self::INFO;

        $this->component->dispatchBrowserEvent("wireui:{$this->getEventName()}", [
            'options'     => $options,
            'componentId' => $this->component->id,
        ]);

        return $this;
    }

    public function confirm(array $options): self
    {
        $options['icon'] ??= self::QUESTION;

        $this->component->dispatchBrowserEvent("wireui:confirm-{$this->getEventName()}", [
            'options'     => $options,
            'componentId' => $this->component->id,
        ]);

        return $this;
    }

    public function success(string $title, ?string $description = null): self
    {
        return $this->simpleDialog(self::SUCCESS, $title, $description);
    }

    public function error(string $title, ?string $description = null): self
    {
        return $this->simpleDialog(self::ERROR, $title, $description);
    }

    public function info(string $title, ?string $description = null): self
    {
        return $this->simpleDialog(self::INFO, $title, $description);
    }

    public function warning(string $title, ?string $description = null): self
    {
        return $this->simpleDialog(self::WARNING, $title, $description);
    }

    public function simpleDialog(
        string $icon,
        string $title,
        ?string $description = null
    ): self {
        $options = [
            'icon'        => $icon,
            'title'       => $title,
            'description' => $description,
        ];

        $this->show($options);

        return $this;
    }
}

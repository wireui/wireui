<?php

namespace WireUi\Support;

use Illuminate\Support\Str;

class Dialog extends Actionable
{
    public ?string $id = null;

    public function id(?string $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    public static function makeEventName(?string $id): string
    {
        $event = 'dialog';

        if ($id = Str::kebab($id)) {
            return "{$event}:{$id}";
        }

        return $event;
    }

    public function show(array $options): self
    {
        $this->component->dispatchBrowserEvent("wireui:{$this::makeEventName($this->id)}", [
            'options'     => $options,
            'componentId' => $this->component->id,
        ]);

        return $this;
    }

    public function confirm(array $options): self
    {
        $options['icon'] ??= self::QUESTION;

        $this->component->dispatchBrowserEvent("wireui:confirm-{$this::makeEventName($this->id)}", [
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

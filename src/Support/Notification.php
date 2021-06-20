<?php

namespace WireUi\Support;

class Notification extends Actionable
{
    public function notify(array $options): self
    {
        $this->component->dispatchBrowserEvent('wireui:notification', [
            'options'     => $options,
            'componentId' => $this->component->id,
        ]);

        return $this;
    }

    public function confirm(array $options): self
    {
        $options['icon'] ??= self::QUESTION;

        $this->component->dispatchBrowserEvent('wireui:confirm-notification', [
            'options'     => $options,
            'componentId' => $this->component->id,
        ]);

        return $this;
    }

    public function success(string $title, ?string $description = null): self
    {
        return $this->simpleNotification(self::SUCCESS, $title, $description);
    }

    public function error(string $title, ?string $description = null): self
    {
        return $this->simpleNotification(self::ERROR, $title, $description);
    }

    public function info(string $title, ?string $description = null): self
    {
        return $this->simpleNotification(self::INFO, $title, $description);
    }

    public function warning(string $title, ?string $description = null): self
    {
        return $this->simpleNotification(self::WARNING, $title, $description);
    }

    public function simpleNotification(
        string $icon,
        string $title,
        ?string $description = null
    ): self {
        $options = [
            'icon'        => $icon,
            'title'       => $title,
            'description' => $description,
        ];

        $this->notify($options);

        return $this;
    }
}

<?php

namespace WireUi\Actions;

class Notification extends Actionable
{
    public function send(array $options): self
    {
        $this->component->dispatchBrowserEvent('wireui:notification', [
            'options'     => $options,
            'componentId' => $this->component->id,
        ]);

        return $this;
    }

    /**
     * @deprecated version v1.3.0
     * use the `send()` method instead
     */
    public function notify(array $options): self
    {
        return $this->send($options);
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

        $this->send($options);

        return $this;
    }
}

<?php

namespace WireUi\Traits;

use WireUi\Actions\{Dialog, Notification};

trait WireUiActions
{
    // public function dialog(array $options = []): Dialog
    // {
    //     $dialog = new Dialog($this);

    //     if ($options) {
    //         return $dialog->show($options);
    //     }

    //     return $dialog;
    // }

    public function dialog(): Dialog
    {
        return new Dialog($this);
    }

    // public function notification(array $options = []): Notification
    // {
    //     $notification = new Notification($this);

    //     if ($options) {
    //         return $notification->send($options);
    //     }

    //     return $notification;
    // }

    public function notification(): Notification
    {
        return new Notification($this);
    }

    public function openModal(string $modalId): void
    {
        // $this->dispatchBrowserEvent('wireui:open-modal', [
        //     'modalId' => $modalId,
        // ]);
    }

    public function closeModal(string $modalId): void
    {
        // $this->dispatchBrowserEvent('wireui:close-modal', [
        //     'modalId' => $modalId,
        // ]);
    }
}

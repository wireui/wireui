<?php

namespace WireUi\Traits;

use Illuminate\Support\Str;
use WireUi\Actions\{Dialog, Notification};

trait WireUiActions
{
    public function dialog(): Dialog
    {
        return new Dialog($this);
    }

    public function notification(): Notification
    {
        return new Notification($this);
    }

    public function openModal(string $modal): void
    {
        $modal = Str::kebab($modal);

        $this->dispatchBrowserEvent("open-wireui-modal:{$modal}");
    }

    public function closeModal(string $modal): void
    {
        $modal = Str::kebab($modal);

        $this->dispatchBrowserEvent("close-wireui-modal:{$modal}");
    }
}

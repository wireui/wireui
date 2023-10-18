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

    // todo: refactor this
    public function openModal(string $modal): void
    {
        $modal = Str::kebab($modal);

        $this->dispatch("open-wireui-modal:{$modal}");
    }

    // todo: refactor this
    public function closeModal(string $modal): void
    {
        $modal = Str::kebab($modal);

        $this->dispatch("close-wireui-modal:{$modal}");
    }
}

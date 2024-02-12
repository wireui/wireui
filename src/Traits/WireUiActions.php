<?php

namespace WireUi\Traits;

use WireUi\Actions\{Dialog, Modal, Notification};

trait WireUiActions
{
    public function modal(): Modal
    {
        return new Modal($this);
    }

    public function dialog(): Dialog
    {
        return new Dialog($this);
    }

    public function notification(): Notification
    {
        return new Notification($this);
    }
}

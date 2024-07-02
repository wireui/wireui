<?php

namespace WireUi\Traits;

use WireUi\Actions\Dialog;
use WireUi\Actions\Modal;
use WireUi\Actions\Notification;

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

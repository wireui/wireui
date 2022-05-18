<?php

namespace WireUi\Traits;

use WireUi\Actions\{Dialog, Notification};

trait Actions
{
    public function notification(): Notification
    {
        return new Notification($this);
    }

    public function dialog(): Dialog
    {
        return new Dialog($this);
    }
}

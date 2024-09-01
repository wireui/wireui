<?php

namespace WireUi\Traits\Components;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;

trait InteractsWithErrors
{
    public function errors(): ViewErrorBag
    {
        return View::shared('errors', new ViewErrorBag);
    }
}

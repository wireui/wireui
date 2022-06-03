<?php

namespace Tests\Unit;

use Tests\Browser\Button\ButtonComponent;
use WireUi\Traits\Actions;

class LivewireComponent extends ButtonComponent
{
    use Actions;

    public function __construct()
    {
        $this->id = 'fake-id';
    }
}

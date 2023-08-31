<?php

namespace Tests\Unit;

use Tests\Browser\Button\ButtonComponent;
use WireUi\Traits\Actions;

class TestComponent extends ButtonComponent
{
    use Actions;

    public function __construct()
    {
        $this->setId('fake-id');
    }
}

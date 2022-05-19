<?php

namespace Tests\Unit;

use Tests\Browser\Button\Component;
use WireUi\Traits\Actions;

class LivewireComponent extends Component
{
    use Actions;

    public function __construct()
    {
        $this->id = 'fake-id';
    }
}

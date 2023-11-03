<?php

namespace Tests\Unit;

use Livewire\Component;
use WireUi\Traits\WireUiActions;

class TestComponent extends Component
{
    use WireUiActions;

    public function __construct()
    {
        $this->setId('fake-id');
    }
}

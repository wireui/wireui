<?php

namespace Tests\Unit;

use Livewire\Component;
use WireUi\Traits\{Actions, WireUiActions};

class LivewireComponent extends Component
{
    use WireUiActions;

    public function __construct()
    {
        $this->setId('fake-id');
    }
}

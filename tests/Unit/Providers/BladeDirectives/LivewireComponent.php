<?php

namespace Tests\Unit\Providers\BladeDirectives;

use Livewire\Component;
use WireUi\Traits\WireUiActions;

class LivewireComponent extends Component
{
    use WireUiActions;

    public function __construct()
    {
        $this->setId('foo');
    }

    public function render()
    {
        return '<div></div>';
    }
}

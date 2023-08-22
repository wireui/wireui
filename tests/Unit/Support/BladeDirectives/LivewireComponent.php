<?php

namespace Tests\Unit\Support\BladeDirectives;

use Livewire\Component;
use WireUi\Traits\Actions;

class LivewireComponent extends Component
{
    use Actions;

    public function __construct()
    {
        $this->setId('foo');
    }

    public function render()
    {
        return '<div></div>';
    }
}

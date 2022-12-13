<?php

namespace Tests\Unit;

use Livewire\Component;
use WireUi\Traits\Actions;

class LivewireComponent extends Component
{
    use Actions;

    public function __construct()
    {
        parent::__construct(id: 'fake-id');
    }

    public function render(): string
    {
        return 'test';
    }
}

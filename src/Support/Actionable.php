<?php

namespace WireUi\Support;

use Livewire\Component;

abstract class Actionable
{
    public const SUCCESS  = 'success';
    public const ERROR    = 'error';
    public const INFO     = 'info';
    public const WARNING  = 'warning';
    public const QUESTION = 'question';

    protected Component $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }
}

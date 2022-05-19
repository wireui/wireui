<?php

namespace WireUi\Actions;

use Livewire\Component;

abstract class Actionable
{
    public const SUCCESS  = 'success';
    public const ERROR    = 'error';
    public const INFO     = 'info';
    public const WARNING  = 'warning';
    public const QUESTION = 'question';

    public function __construct(
        protected Component $component
    ) {
    }
}

<?php

namespace WireUi\Enum;

enum Actions: string
{
    case SUCCESS  = 'success';
    case ERROR    = 'error';
    case INFO     = 'info';
    case WARNING  = 'warning';
    case QUESTION = 'question';
}

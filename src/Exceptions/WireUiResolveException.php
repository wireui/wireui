<?php

namespace WireUi\Exceptions;

use Exception;

class WireUiResolveException extends Exception
{
    public function __construct(object $component)
    {
        $class = get_class($component);

        parent::__construct("Absence of Resolve for the Component [{$class}].", 500);
    }
}

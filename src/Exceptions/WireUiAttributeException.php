<?php

namespace WireUi\Exceptions;

use Exception;

class WireUiAttributeException extends Exception
{
    public function __construct(object $component)
    {
        $class = get_class($component);

        parent::__construct("Required Attribute is Invalid for the Pack [{$class}].", 500);
    }
}

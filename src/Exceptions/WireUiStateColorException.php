<?php

namespace WireUi\Exceptions;

use Exception;

class WireUiStateColorException extends Exception
{
    public function __construct(object $component)
    {
        $class = get_class($component);

        parent::__construct("You must use Variant and Color Setup Traits in Component [{$class}].", 500);
    }
}

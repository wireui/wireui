<?php

namespace WireUi\Exceptions;

use Exception;

class WireUiMaskableException extends Exception
{
    public function __construct(object $component)
    {
        $class = get_class($component);

        parent::__construct("Implement this method [getInputMask] on your Component [{$class}] or pass [mask] in parameters.", 500);
    }
}

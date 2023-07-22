<?php

use Illuminate\View\ComponentSlot;

/**
 * Check if the given slot is a component slot.
 */
if (! function_exists('check_slot')) {
    function check_slot(mixed $slot): bool
    {
        return $slot instanceof ComponentSlot;
    }
}

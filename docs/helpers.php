<?php

use Illuminate\Support\Str;

/**
 * Get Livewire Component Attributes.
 */
if (!function_exists('get_attributes')) {
    function get_attributes(mixed $component)
    {
        return get_object_vars($component);
    }
}

/**
 * Serialize a Slot.
 */
if (!function_exists('serialize_slot')) {
    function serialize_slot(mixed $slot): string
    {
        $content = html_entity_decode($slot);

        $lines = collect(explode(PHP_EOL, $content));

        $tab = str_repeat(' ', strlen($lines->last()) - strlen(trim($lines->last())));

        return $lines->map(fn (string $line) => Str::replaceFirst($tab, '', $line))->implode(PHP_EOL);
    }
}

<?php

use Illuminate\Support\Str;

if (!function_exists('check_result')) {
    /*
    |--------------------------------------------------------------------------
    | Check if the result is a json string or string,
    | if it is, it will be converted to an array.
    |--------------------------------------------------------------------------
    */
    function check_result(mixed $classes): mixed
    {
        return Str::isJson($classes) ? json_decode($classes, true) : $classes;
    }
}

if (!function_exists('convert_result')) {
    /*
    |--------------------------------------------------------------------------
    | Convert the result to a json string if it is an array.
    |--------------------------------------------------------------------------
    */
    function convert_result(mixed $classes): mixed
    {
        return is_array($classes) ? json_encode($classes) : $classes;
    }
}

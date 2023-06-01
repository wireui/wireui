<?php

use Illuminate\Support\Facades\File;
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

if (!function_exists('resolve_wireui')) {
    /*
    |--------------------------------------------------------------------------
    | Resolve a class from the WireUi namespace, if the class
    | exists in the App namespace, it will be resolved from there.
    |--------------------------------------------------------------------------
    */
    function resolve_wireui(string $class): mixed
    {
        $app = app_path(Str::replace('\\', '/', Str::replaceFirst('WireUi\\', '', $class)) . '.php');

        return File::exists($app) ? resolve(Str::replaceFirst('WireUi', 'App', $class)) : resolve($class);
    }
}

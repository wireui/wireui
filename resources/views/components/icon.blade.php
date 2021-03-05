@props(['style' => config('wireui.icons.style'), 'name'])

<x-dynamic-component component="wireui::icons.{{ $style }}.{{ $name }}" {{ $attributes }} />

@props([
    'style' => config('wireui.icons.style'),
    'size'  => config('wireui.icons.size'),
    'name',
])

<x-dynamic-component component="wireui::icons.{{ $style }}.{{ $name }}"
    {{ $attributes->merge(['class' => 'h-.'.$size.' w-'.$size]) }} />

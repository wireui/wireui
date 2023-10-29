<div
    {{ $attributes->class([
        'relative w-full h-72 select-none overflow-hidden',
        'flex items-center text-center px-4',
        'text-gray-400',
        'bg-white border border-gray-200 rounded-md shadow-sm',
    ]) }}
    x-data="wireui_time_selector"
>
    <div @class([
        'absolute bg-primary-50 left-0 h-10 w-full transform transition-opacity',
    ])></div>

    <ul class="w-full" x-ref="hours"></ul>
    <ul class="w-full" x-ref="minutes"></ul>
    <ul class="w-full" x-ref="seconds"></ul>
</div>

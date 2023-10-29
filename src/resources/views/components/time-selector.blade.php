<div
    {{ $attributes->class([
        'relative w-full h-72 select-none overflow-hidden',
        'flex items-center text-center px-4',
        'text-gray-400',
        'bg-white border border-gray-200 rounded-md shadow-sm',
    ])->whereDoesntStartWith(['wire:model', 'x-model']) }}
    x-data="wireui_time_selector"
    x-props="{{ WireUi::toJs([
        'format'   => $format,
        'disabled' => $disabled,
        'readonly' => $readonly,
    ]) }}"
>
    <input
        {{ $attributes->whereStartsWith(['value', 'wire:model', 'x-model'])}}
        x-ref="input"
        :value="value"
        type="hidden"
    />

    <div @class([
        'absolute bg-primary-50 left-0 h-10 w-full transform transition-opacity',
    ])></div>

    <ul class="w-full" x-ref="hours"></ul>
    <ul class="w-full" x-ref="minutes"></ul>
    <ul class="w-full" x-ref="seconds"></ul>
    <ul
        class="w-full h-full flex flex-col justify-center"
        style="top: 14px"
        x-ref="period"
    ></ul>
</div>

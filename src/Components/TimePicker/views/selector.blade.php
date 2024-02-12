<div
    {{ $attributes->class([
        'relative w-full h-72 select-none overflow-hidden',
        'flex items-center text-center text-gray-400 px-4',
        'bg-white border border-gray-200'                => !$borderless,
        'dark:bg-background-dark dark:border-gray-600'   => !$borderless,
        $roundedClasses                                  => !$squared,
        $shadowClasses                                   => !$shadowless,
    ])->whereDoesntStartWith(['wire:model', 'x-model']) }}
    x-data="wireui_time_selector"
    x-props="{{ WireUi::toJs([
        'wireModel'      => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
        'militaryTime'   => $militaryTime,
        'withoutSeconds' => $withoutSeconds,
        'disabled'       => $disabled,
        'readonly'       => $readonly,
    ]) }}"
>
    <input
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-model.fill="timeInput"
        x-ref="input"
        type="hidden"
    />

    <div @class([
        'absolute bg-primary-50 dark:bg-primary-200/10 left-0 h-10 w-full transform transition-opacity',
    ])></div>

    <ul class="w-full" x-ref="hours"></ul>

    <ul class="w-full" x-ref="minutes"></ul>

    <ul
        class="w-full"
        x-ref="seconds"
        x-show="config.seconds"
    ></ul>

    <ul
        class="w-full h-full flex flex-col justify-center"
        style="top: 14px"
        x-ref="period"
        x-show="!config.military"
    ></ul>
</div>

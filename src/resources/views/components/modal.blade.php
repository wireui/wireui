@php($name = $name ?? $attributes->wire('model')->value())

<div
    x-data="wireui_modal"
    x-props="{
        state: @toJs($state),
        id: @toJs($id),
        wireModel: @toJs(WireUi::wireModel(isset($__livewire) ? $this : null, $attributes)),
    }"
    x-on:keydown.escape.window="handleEscape"
    {{-- todo: refactor events --}}
    x-on:open-wireui-modal:{{ Str::kebab($name) }}.window="open"
    x-on:close-wireui-modal:{{ Str::kebab($name) }}.window="close"
    {{ $attributes
        ->class($getRootClasses())
        ->whereDoesntStartWith('wire:model')
        ->whereStartsWith(['x-on:', '@', 'wire:']) }}
    style="display: none"
    x-cloak
    x-show="state"
    wireui-modal
>
    <div
        class="{{ $getBackdropClasses() }}"
        x-show="state"
        x-on:click="close"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    ></div>

    <div
        class="{{ $getMainClasses() }}"
        x-show="state"
        x-trap.noscroll="state"
        x-on:click.self="close"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        {{ $slot }}
    </div>
</div>

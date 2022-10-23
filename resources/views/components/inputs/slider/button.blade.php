@props([
    'input' => null,
    'button' => null,
    'disabled' => false,
    'has-error' => false,
])

<div x-ref="{{ $button }}">
    <div
        tabindex="0"
        x-data="wireui_inputs_slider_button({ input: @toJs($input) })"
        class="{{ $getButtonGridClasses() }}"
        x-bind:style="wrapperStyle"
    >
        <x-dynamic-component
            tabindex="0"
            :component="WireUi::component('button.circle')"
            x-on:mouseenter="buttonEnter"
            x-on:mouseleave="buttonLeave"
            x-on:mousedown="buttonDown"
            x-on:touchstart="buttonDown"
            x-on:mousemove.window="dragging ? onDragging : ''"
            x-on:touchmove.window="dragging ? onDragging : ''"
            x-on:mouseup.window="dragging ? onDragEnd : ''"
            x-on:touchend.window="dragging ? onDragEnd : ''"
            x-on:contextmenu.window="dragging ? onDragEnd : ''"
            :color="$buttonError($disabled, $hasError)"
            :class="$getButtonClasses($disabled)"
            :size="$buttonSizes()"
            x-bind:style="buttonStyle"
            {{-- x-text="value" --}}
            outline
        />
    </div>
</div>

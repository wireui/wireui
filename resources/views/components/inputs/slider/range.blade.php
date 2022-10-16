@php
    $hasError = !$errorless && $name && $errors->has($name);

    $min = $formatDataSliderRange($attributes, 'min');
    $max = $formatDataSliderRange($attributes, 'max');
@endphp

<div x-ref="sliderComponent" x-data="wireui_inputs_slider_range({
    range: @boolean($range),
    disabled: @boolean($disabled),
    showStops: @boolean($showStops),
    hideTooltip: @boolean($hideTooltip),
})" {{ $attributes->only('wire:key') }}>

    @if ($label || $cornerHint)
        <div class="flex {{ !$label && $cornerHint ? 'justify-end' : 'justify-between' }} mb-1">
            @if ($label)
                <x-dynamic-component
                    :component="WireUi::component('label')"
                    :label="$label"
                    :has-error="$hasError"
                    :for="$id"
                />
            @endif

            @if ($cornerHint)
                <x-dynamic-component
                    :component="WireUi::component('label')"
                    :label="$cornerHint"
                    :has-error="$hasError"
                    :for="$id"
                />
            @endif
        </div>
    @endif

    <input x-on:change="inputChange" x-ref="input1" {{ $min->class('')->merge($formatDataSlider($attributes)) }} />

    <input x-on:change="inputChange" x-ref="input2" {{ $max->class('')->merge($formatDataSlider($attributes)) }} />

    <div x-ref="slider" x-on:click="sliderClick" class="{{ $getSliderClasses($disabled) }}">

        <div class="{{ $getBarClasses($disabled, $hasError) }}" x-bind:style="barStyle"></div>

        @include('wireui::components.inputs.slider.button', [
            'input' => 'input1',
            'button' => 'button1',
            'disabled' => $disabled,
            'has-error' => $hasError,
        ])

        @include('wireui::components.inputs.slider.button', [
            'input' => 'input2',
            'button' => 'button2',
            'disabled' => $disabled,
            'has-error' => $hasError,
        ])

        @include('wireui::components.inputs.slider.stops', [
            'show-stops' => $showStops,
        ])
    </div>

    @if (!$hasError && $hint)
        <label @if ($id) for="{{ $id }}" @endif class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">
            {{ $hint }}
        </label>
    @endif

    @if ($name && !$errorless)
        <x-dynamic-component
            :component="WireUi::component('error')"
            :name="$name"
        />
    @endif
</div>

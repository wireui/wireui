@php
    $hasError = !$errorless && $name && $errors->has($name);
@endphp

<div x-ref="sliderComponent" x-data="wireui_inputs_slider_range({
    stops: @toJs($stops),
    range: @boolean($range),
    disabled: @boolean($disabled),
    showStops: @boolean($showStops),
    hideTooltip: @boolean($hideTooltip),
})" {{ $attributes->only(['class', 'wire:key']) }}>

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

    <input x-on:change="inputChange" x-ref="input1"
        {{ $attributes
            ->except(['class', 'wire:key', 'id', 'name'])
            ->class('hidden')
            ->merge($formatDataSlider($attributes))
            ->merge($formatDataSliderRange($min)->getAttributes())
        }}
    />

    <input x-on:change="inputChange" x-ref="input2"
        {{ $attributes
            ->except(['class', 'wire:key', 'id', 'name'])
            ->class('hidden')
            ->merge($formatDataSlider($attributes))
            ->merge($formatDataSliderRange($max)->getAttributes())
        }}
    />

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
            'stops' => $stops,
            'has-error' => $hasError,
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

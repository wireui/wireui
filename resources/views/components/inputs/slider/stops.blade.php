@props([
    'stops' => [],
    'has-error' => false,
    'show-stops' => false,
])

@if ($stops->isNotEmpty() || $showStops)
    <template x-for="stop in stops">
        <div>
            <div
                class="{{ $getStopClasses() }}"
                x-bind:style="stopStyle(stop, true)"
            ></div>

            <div
                x-text="stop.label"
                class="{{ $getStopLabelClasses($hasError) }}"
                x-bind:style="stopStyle(stop)"
            ></div>
        </div>
    </template>
@endif

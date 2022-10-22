@props(['show-stops' => false])

@if ($showStops)
    <template x-for="stop in stops">
        <div
            class="{{ $getStopClasses() }}"
            x-bind:style="stopStyle(stop)"
        ></div>
    </template>
@endif

<div
    class="relative inline-block cursor-default"
    x-data="{
        show: false,
        tooltipTimeout: {{ $timeout ?? 0 }},
        showTooltip() {
            if (this.tooltipTimeout > 0) {
                setTimeout(() => this.show = true, this.tooltipTimeout)
            } else {
                this.show = true
            }
        },
        hideTooltip() {
            this.show = false
        }
    }"
>
    <div
        {{ $attributes->class([
            'absolute z-50 px-3 py-1 text-sm text-white bg-black rounded shadow-lg whitespace-nowrap',
            'top-full left-1/2 -translate-x-1/2 mt-2' => $position === 'bottom',
            'right-full top-1/2 -translate-y-1/2 mr-2' => $position === 'left',
            'left-full top-1/2 -translate-y-1/2 ml-2' => $position === 'right',
            'bottom-full left-1/2 -translate-x-1/2 mb-2' => $position === 'top',
        ]) }}
        x-show="show"
        x-cloak
        x-transition
    >
        {{ $text }}
    </div>

    <div
        @mouseover="showTooltip()"
        @mouseover.away="hideTooltip()"
    >
        {{ $slot }}
    </div>
</div>

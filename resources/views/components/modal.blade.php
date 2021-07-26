@php $model = $attributes->wire('model'); @endphp

<div class="fixed inset-0 overflow-y-auto {{ $zIndex }}"
    x-data="{
        show: @entangle($model),

        close() { this.show = false },
        focusables() {
            const selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'

            return [...$el.querySelectorAll(selector)].filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        previousFocusable() { return this.focusables()[this.previousFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        previousFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="function() {
        $watch('show', value => {
            value
                ? document.body.classList.add('overflow-y-hidden')
                : document.body.classList.remove('overflow-y-hidden')

            this.$el.dispatchEvent(new Event(value ? 'open' : 'close'))
        })
    }"
    x-on:keydown.escape.window="close"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="previousFocusable().focus()"
    x-on:open-modal:{{ Str::kebab((string)$model) }}.window="show = true"
    {{ $attributes->whereStartsWith(['x-on:', '@']) }}
    style="display: none"
    x-show="show">
    <div class="flex items-end {{ $align }} min-h-screen justify-center w-full
                relative transform transition-all {{ $spacing }}"
        style="min-height: -webkit-fill-available; min-height: fill-available;">
        <div class="fixed inset-0 bg-secondary-400 dark:bg-secondary-700 bg-opacity-60
                    dark:bg-opacity-60 transform transition-opacity
            @if($blur) backdrop-filter {{ $blur }} @endif"
            x-show="show"
            x-on:click="close"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
        </div>

        <div class="w-full {{ $maxWidth }} z-10"
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            {{ $slot }}
        </div>
    </div>
</div>

<div x-data="wireui_tooltip({
    'message': @js($message),
    'placement': @js($placement),
    'arrow': @boolean($arrow),
    'animation': @js($animation),
    'theme': @js($theme),
    'trigger': @js($trigger),
    'timeout': @js($timeout),
})">
    @unless($message)
        <div class="hidden" x-ref="tooltip">
            {{ $tooltip }}
        </div>
    @endunless

    <div x-ref="content">
        {{ $slot }}
    </div>
</div>

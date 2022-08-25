<div x-data="wireui_tooltip({
    'message': @toJs($message),
    'placement': @toJs($placement),
    'arrow': @boolean($arrow),
    'animation': @toJs($animation),
    'theme': @toJs($theme),
    'trigger': @toJs($trigger),
    'timeout': @toJs($timeout),
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

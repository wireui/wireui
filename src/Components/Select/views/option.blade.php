<div name="wireui.select.option">
    <span name="wireui.select.option.data">
        {{ WireUi::toJs($toArray()) }}
    </span>

    @if (app()->runningUnitTests())
        <div dusk="select.option">
            {!! json_encode($toArray()) !!}
        </div>
    @endif

    @if ($slot->isNotEmpty())
        <span name="wireui.select.slot">{{ $slot }}</span>
    @endif
</div>

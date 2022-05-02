<div name="wireui.select.option">
    <span name="wireui.select.json">{!! $jsonOption() !!}</span>
    @if ($slot->isNotEmpty())
        <span name="wireui.select.slot">{{ $slot }}</span>
    @endif
</div>

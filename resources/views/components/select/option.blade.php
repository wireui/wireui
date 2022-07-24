<div name="wireui.select.option">
    <span name="wireui.select.json">{{ $toJson() }}</span>
    @if ($slot->isNotEmpty())
        <span name="wireui.select.slot">{{ $slot }}</span>
    @endif
</div>

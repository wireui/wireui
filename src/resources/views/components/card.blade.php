<div {{ $attributes->class($getCardClasses()) }}>
    @if (isset($header))
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div class="{{ $getHeaderClasses() }}">
            <h3 class="{{ $getTitleClasses() }}">
                {{ $title }}
            </h3>

            @if (isset($action))
                <div {{ $action->attributes }}>
                    {{ $action }}
                </div>
            @endif
        </div>
    @endif

    <div {{ $attributes->class($getMainClasses()) }}>
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div {{ $footer->attributes->class($getFooterClasses()) }}>
            {{ $footer }}
        </div>
    @endif
</div>

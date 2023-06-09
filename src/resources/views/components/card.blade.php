<div {{ $attributes->class($getRootClasses()) }}>
    @isset($header)
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div class="{{ $getHeaderClasses() }}">
            @if ($checkSlot($title))
                <div {{ $title->attributes->class($getTitleClasses()) }}>
                    {{ $title }}
                </div>
            @else
                <h3 class="{{ $getTitleClasses() }}">
                    {{ $title }}
                </h3>
            @endif

            @isset($action)
                <div {{ $action->attributes }}>
                    {{ $action }}
                </div>
            @endisset
        </div>
    @endisset

    @if ($checkSlot($slot))
        <div {{ $slot->attributes->class($getMainClasses()) }}>
            {{ $slot }}
        </div>
    @else
        <div class="{{ $getMainClasses() }}">
            {{ $slot }}
        </div>
    @endif

    @isset($footer)
        <div {{ $footer->attributes->class($getFooterClasses()) }}>
            {{ $footer }}
        </div>
    @endisset
</div>

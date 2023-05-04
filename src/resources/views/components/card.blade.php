<div {{ $attributes->class($getCardClasses()) }}>
    @isset($header)
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div class="{{ $getHeaderClasses() }}">
            <h3 class="{{ $getTitleClasses() }}">
                {{ $title }}
            </h3>

            @isset($action)
                <div {{ $action->attributes }}>
                    {{ $action }}
                </div>
            @endisset
        </div>
    @endisset

    <div class="{{ $getMainClasses() }}">
        {{ $slot }}
    </div>

    @isset($footer)
        <div {{ $footer->attributes->class($getFooterClasses()) }}>
            {{ $footer }}
        </div>
    @endisset
</div>

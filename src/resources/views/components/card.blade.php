<div {{ $attributes->class($getCardClasses()) }}>
    @if (isset($header))
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div class="px-4 py-2.5 flex justify-between items-center border-b dark:border-0">
            <h3 class="font-medium whitespace-normal text-md text-secondary-700 dark:text-secondary-400">
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

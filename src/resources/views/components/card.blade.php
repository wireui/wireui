<div {{ $attributes->class($getCardClasses()) }}>
    @isset($record)
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div class="px-4 py-2.5 flex justify-between items-center border-b dark:border-0">
            <h3 class="font-medium whitespace-normal text-md text-secondary-700 dark:text-secondary-400">
                {{ $title }}
            </h3>

            @isset($action)
                <div {{ $action->attributes }}>
                    {{ $action }}
                </div>
            @endisset
        </div>
    @endisset

    <div {{ $attributes->class($getMainClasses()) }}>
        {{ $slot }}
    </div>

    @isset($footer)
        <div {{ $footer->attributes->class($getFooterClasses()) }}>
            {{ $footer }}
        </div>
    @endisset
</div>

<div {{ $attributes->class($getAlertClasses($values)) }}>
    @isset($header)
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div class="{{ $getHeaderClasses($values, $slot) }}">
            @if ($values['icon'] && !$iconless)
                <x-dynamic-component
                    :component="WireUi::component('icon')"
                    class="{{ $getIconClasses($values) }}"
                    :name="$values['icon']"
                />
            @endif

            <h3 class="{{ $getTitleClasses($values) }}">
                {{ $title }}
            </h3>

            @isset($action)
                <div {{ $action->attributes }}>
                    {{ $action }}
                </div>
            @endisset
        </div>
    @endisset

    @if ($slot->isNotEmpty())
        <div {{ $attributes->except('class')->class($getMainClasses($values)) }}>
            {{ $slot }}
        </div>
    @endif

    @isset($footer)
        <div {{ $footer->attributes->class($getFooterClasses($values)) }}>
            {{ $footer }}
        </div>
    @endisset
</div>

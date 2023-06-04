@php
    $useIcon = $icon ?? $colorClasses['icon'];
@endphp

<div {{ $attributes->class($getAlertClasses()) }}>
    @isset($header)
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div class="{{ $getHeaderClasses($slot) }}">
            <div class="flex items-center">
                @if ($useIcon && !$iconless)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        class="{{ $getIconClasses() }}"
                        :name="$useIcon"
                    />
                @endif

                <h3 class="{{ $getTitleClasses() }}">
                    {{ $title }}
                </h3>
            </div>

            @isset($action)
                <div {{ $action->attributes }}>
                    {{ $action }}
                </div>
            @endisset
        </div>
    @endisset

    @if ($slot->isNotEmpty())
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

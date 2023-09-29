@php
    $rootClasses = Arr::toCssClasses([
        Arr::get($colorClasses, 'background', ''),
        Arr::get($colorClasses, 'border', ''),
        $shadowClasses => !$shadowless,
        'w-full flex flex-col p-4',
        $roundedClasses,
    ]);

    $headerClasses = Arr::toCssClasses([
        'flex justify-between items-center',
        'pb-3' => $slot->isNotEmpty(),
    ]);

    $iconClasses = Arr::toCssClasses([
        Arr::get($colorClasses, 'iconColor', ''),
        'w-5 h-5 mr-3 shrink-0',
    ]);

    $titleClasses = Arr::toCssClasses([
        'font-semibold' => $slot->isNotEmpty(),
        Arr::get($colorClasses, 'text', ''),
        'font-normal' => $slot->isEmpty(),
        'text-sm whitespace-normal',
    ]);

    $mainClasses = Arr::toCssClasses([
        Arr::get($colorClasses, 'text', ''),
        $paddingClasses,
        'grow text-sm',
    ]);

    $footerClasses = Arr::toCssClasses(['mt-2 pt-2']);
@endphp

<div {{ $attributes->class($rootClasses) }}>
    @isset($header)
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div class="{{ $headerClasses }}">
            <div class="flex items-center">
                @if ($getUseIcon() && !$iconless)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$getUseIcon()"
                        :class="$iconClasses"
                    />
                @endif

                @if (check_slot($title))
                    <div {{ $title->attributes->class($titleClasses) }}>
                        {{ $title }}
                    </div>
                @else
                    <h3 class="{{ $titleClasses }}">
                        {{ $title }}
                    </h3>
                @endif
            </div>

            @isset($action)
                <div {{ $action->attributes }}>
                    {{ $action }}
                </div>
            @endisset
        </div>
    @endisset

    @if ($slot->isNotEmpty())
        @if (check_slot($slot))
            <div {{ $slot->attributes->class($mainClasses) }}>
                {{ $slot }}
            </div>
        @else
            <div class="{{ $mainClasses }}">
                {{ $slot }}
            </div>
        @endif
    @endif

    @isset($footer)
        <div {{ $footer->attributes->class($footerClasses) }}>
            {{ $footer }}
        </div>
    @endisset
</div>

@php
    $rootClasses = Arr::toCssClasses([
        Arr::get($colorClasses, 'root', ''),
        $shadowClasses => !$shadowless,
        $roundedClasses,
    ]);

    $headerClasses = Arr::toCssClasses([
        Arr::get($colorClasses, 'border', '') => !$borderless,
        'px-4 py-2.5 flex justify-between items-center',
        'border-b' => !$borderless,
    ]);

    $titleClasses = Arr::toCssClasses([
        'font-medium text-base whitespace-normal',
        Arr::get($colorClasses, 'text', ''),
    ]);

    $mainClasses = Arr::toCssClasses([
        Arr::get($colorClasses, 'text', ''),
        $paddingClasses,
        'grow',
    ]);

    $footerClasses = Arr::toCssClasses([
        Arr::get($colorClasses, 'border', '') => !$borderless,
        Arr::get($colorClasses, 'footer', ''),
        'px-4 py-4 sm:px-6 bg-clip-content',
        'border-t' => !$borderless,
    ]);
@endphp

<div {{ $attributes->class($rootClasses) }}>
    @isset($header)
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div class="{{ $headerClasses }}">
            @if (check_slot($title))
                <div {{ $title->attributes->class($titleClasses) }}>
                    {{ $title }}
                </div>
            @else
                <h3 class="{{ $titleClasses }}">
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

    @if (check_slot($slot))
        <div {{ $slot->attributes->class($mainClasses) }}>
            {{ $slot }}
        </div>
    @else
        <div class="{{ $mainClasses }}">
            {{ $slot }}
        </div>
    @endif

    @isset($footer)
        <div {{ $footer->attributes->class($footerClasses) }}>
            {{ $footer }}
        </div>
    @endisset
</div>

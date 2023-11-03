<div {{ $attributes->class([
    Arr::get($roundedClasses, 'root', ''),
    Arr::get($colorClasses, 'root', ''),
    $shadowClasses => !$shadowless,
]) }}>
    @isset($header)
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div @class([
            Arr::get($colorClasses, 'border', '') => !$borderless,
            'px-4 py-2.5 flex justify-between items-center',
            Arr::get($roundedClasses, 'header', ''),
            'border-b' => !$borderless,
        ])>
            @if (WireUi::checkSlot($title))
                <div {{ $title->attributes->class([
                    'font-medium text-base whitespace-normal',
                    Arr::get($colorClasses, 'text', ''),
                ]) }}>
                    {{ $title }}
                </div>
            @else
                <h3 @class([
                    'font-medium text-base whitespace-normal',
                    Arr::get($colorClasses, 'text', ''),
                ])>
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

    @if (WireUi::checkSlot($slot))
        <div {{ $slot->attributes->class([
            Arr::get($colorClasses, 'text', ''),
            $paddingClasses,
            'grow',
        ]) }}>
            {{ $slot }}
        </div>
    @else
        <div @class([
            Arr::get($colorClasses, 'text', ''),
            $paddingClasses,
            'grow',
        ])>
            {{ $slot }}
        </div>
    @endif

    @isset($footer)
        <div {{ $footer->attributes->class([
            Arr::get($colorClasses, 'border', '') => !$borderless,
            Arr::get($roundedClasses, 'footer', ''),
            Arr::get($colorClasses, 'footer', ''),
            'border-t' => !$borderless,
            'px-4 py-4 sm:px-6',
        ]) }}>
            {{ $footer }}
        </div>
    @endisset
</div>

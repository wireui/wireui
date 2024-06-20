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
            <div {{ WireUi::extractAttributes($title)->class([
                'font-medium text-base whitespace-normal',
                Arr::get($colorClasses, 'text', ''),
            ]) }}>
                {{ $title }}
            </div>

            @isset($action)
                <div {{ $action->attributes }}>
                    {{ $action }}
                </div>
            @endisset
        </div>
    @endisset

    <div {{ WireUi::extractAttributes($slot)->class([
        Arr::get($colorClasses, 'text', ''),
        $paddingClasses,
        'grow',
    ]) }}>
        {{ $slot }}
    </div>

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

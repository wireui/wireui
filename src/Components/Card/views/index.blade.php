<div {{ $attributes->class([
    data_get($roundedClasses, 'root', ''),
    data_get($colorClasses, 'root', ''),
    $shadowClasses => !$shadowless,
]) }}>
    @isset($header)
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div @class([
            data_get($colorClasses, 'border', '') => !$borderless,
            'px-4 py-2.5 flex justify-between items-center',
            data_get($roundedClasses, 'header', ''),
            'border-b' => !$borderless,
        ])>
            <div {{ WireUi::extractAttributes($title)->class([
                'font-medium text-base whitespace-normal',
                data_get($colorClasses, 'text', ''),
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
        data_get($colorClasses, 'text', ''),
        $paddingClasses,
        'grow',
    ]) }}>
        {{ $slot }}
    </div>

    @isset($footer)
        <div {{ $footer->attributes->class([
            data_get($colorClasses, 'border', '') => !$borderless,
            data_get($roundedClasses, 'footer', ''),
            data_get($colorClasses, 'footer', ''),
            'border-t' => !$borderless,
            'px-4 py-4 sm:px-6',
        ]) }}>
            {{ $footer }}
        </div>
    @endisset
</div>

<div {{ $attributes->class([
    data_get($colorClasses, 'background', ''),
    data_get($colorClasses, 'border', ''),
    $shadowClasses => !$shadowless,
    'w-full flex flex-col p-4',
    $roundedClasses,
]) }}>
    @isset($header)
        <div {{ $header->attributes }}>
            {{ $header }}
        </div>
    @elseif($title)
        <div @class([
            'flex justify-between items-center',
            'pb-3' => $slot->isNotEmpty(),
        ])>
            <div class="flex items-center">
                @if ($icon && !$iconless)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$icon"
                        @class([
                            data_get($colorClasses, 'iconColor', ''),
                            'w-5 h-5 mr-3 shrink-0',
                        ])
                    />
                @endif

                <div {{ WireUi::extractAttributes($title)->class([
                    'font-semibold' => $slot->isNotEmpty(),
                    data_get($colorClasses, 'text', ''),
                    'font-normal' => $slot->isEmpty(),
                    'text-sm whitespace-normal',
                ]) }}>
                    {{ $title }}
                </div>
            </div>

            @isset($action)
                <div {{ $action->attributes }}>
                    {{ $action }}
                </div>
            @endisset
        </div>
    @endisset

    @if ($slot->isNotEmpty())
        <div {{ WireUi::extractAttributes($slot)->class([
            data_get($colorClasses, 'text', ''),
            $paddingClasses,
            'grow text-sm',
        ]) }}>
            {{ $slot }}
        </div>
    @endif

    @isset($footer)
        <div {{ $footer->attributes->class('mt-2 pt-2') }}>
            {{ $footer }}
        </div>
    @endisset
</div>

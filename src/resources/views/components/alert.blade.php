<div {{ $attributes->class([
    Arr::get($colorClasses, 'background', ''),
    Arr::get($colorClasses, 'border', ''),
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
                @if ($getUseIcon() && !$iconless)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$getUseIcon()"
                        @class([
                            Arr::get($colorClasses, 'iconColor', ''),
                            'w-5 h-5 mr-3 shrink-0',
                        ])
                    />
                @endif

                @if (check_slot($title))
                    <div {{ $title->attributes }}>
                        {{ $title }}
                    </div>
                @else
                    <h3 @class([
                        'font-semibold' => $slot->isNotEmpty(),
                        Arr::get($colorClasses, 'text', ''),
                        'font-normal' => $slot->isEmpty(),
                        'text-sm whitespace-normal',
                    ])>
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
            <div {{ $slot->attributes }}>
                {{ $slot }}
            </div>
        @else
            <div @class([
                Arr::get($colorClasses, 'text', ''),
                $paddingClasses,
                'grow text-sm',
            ])>
                {{ $slot }}
            </div>
        @endif
    @endif

    @isset($footer)
        <div {{ $footer->attributes->class('mt-2 pt-2') }}>
            {{ $footer }}
        </div>
    @endisset
</div>

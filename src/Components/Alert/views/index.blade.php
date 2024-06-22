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
                @if ($icon && !$iconless)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$icon"
                        @class([
                            Arr::get($colorClasses, 'iconColor', ''),
                            'w-5 h-5 mr-3 shrink-0',
                        ])
                    />
                @endif

                <div {{ WireUi::extractAttributes($title)->class([
                    'font-semibold' => $slot->isNotEmpty(),
                    Arr::get($colorClasses, 'text', ''),
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
            Arr::get($colorClasses, 'text', ''),
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

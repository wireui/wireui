<div {{ $attributes->class([
    'shrink-0 inline-flex items-center justify-center overflow-hidden',
    Arr::get($this->colorClasses, 'border', '') => !$this->borderless,
    Arr::get($this->colorClasses, 'label', '') => !$this->src,
    $this->borderClasses => !$this->borderless,
    $this->sizeClasses => !$this->src,
    $this->roundedClasses,
    $this->sizeClasses,
]) }}>
    @if ($label)
        @if (check_slot($label))
            <div {{ $label->attributes }}>
                {{ $label }}
            </div>
        @else
            <span @class([
                Arr::get($this->iconSizeClasses, 'label', 'text-base'),
                'font-medium text-white dark:text-gray-200',
            ])>
                {{ $label }}
            </span>
        @endif
    @elseif ($src)
        <img
            src="{{ $src }}"
            @class([
                'shrink-0 object-cover object-center',
                $this->roundedClasses,
                $this->sizeClasses,
            ])
        />
    @else
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon ?? 'user'"
            solid
            @class([
                Arr::get($this->iconSizeClasses, 'icon', 'w-7 h-7'),
                'text-white dark:text-gray-200 shrink-0',
            ])
        />
    @endif
</div>

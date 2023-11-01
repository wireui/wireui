<x-wrapper.switcher
    :data="$wrapperData"
    :attributes="$attributes->only(['wire:key'])"
>
    @include('wireui::components.wrapper.slots')

    <input
        {{ $attributes
            ->class([
                'form-checkbox transition ease-in-out duration-100',
                $roundedClasses,
                $colorClasses,
                $sizeClasses,
            ])
            ->merge(['type' => 'checkbox'])
        }}
    />
</x-wrapper.switcher>

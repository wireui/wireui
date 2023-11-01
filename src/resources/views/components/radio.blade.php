<x-wrapper.switcher
    :data="$wrapperData"
    :attributes="$attributes->only(['wire:key'])"
>
    @include('wireui::components.wrapper.slots')

    <input
        {{ $attributes
            ->class([
                'form-radio transition ease-in-out duration-100',
                $roundedClasses,
                $colorClasses,
                $sizeClasses,
            ])
            ->merge(['type' => 'radio'])
        }}
    />
</x-wrapper.switcher>

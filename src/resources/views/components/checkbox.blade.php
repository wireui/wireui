<x-wrapper.switcher
    :attributes="$attributes->only(['wire:key'])"
    :data="$wrapperData"
>
    @include('wireui::components.wrapper.slots')

    <input
        {{ $attributes
            ->class([
                'form-checkbox transition ease-in-out duration-100',
                'border-secondary-300 text-primary-600 focus:ring-primary-600 focus:border-primary-400',
                'dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600',
                'dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600',
                'dark:focus:ring-offset-secondary-800',

                'invalidated:focus:ring-negative-500 invalidated:ring-negative-500 invalidated:border-negative-400 invalidated:text-negative-600',
                'invalidated:focus:border-negative-400 invalidated:dark:focus:border-negative-600 invalidated:dark:ring-negative-600',
                'invalidated:dark:border-negative-600 invalidated:dark:bg-negative-700 invalidated:dark:checked:bg-negative-700',
                'invalidated:dark:focus:ring-offset-secondary-800 invalidated:dark:checked:border-negative-700',

                $roundedClasses,
                $colorClasses,
                $sizeClasses,
            ])
            ->merge(['type' => 'checkbox'])
        }}
    />
</x-wrapper.switcher>

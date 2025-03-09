<x-dynamic-component
    :component="WireUi::component('switcher')"
    :config="$config"
    :attributes="$wrapper"
>
    @include('wireui-wrapper::components.slots')

    <input {{ $input
        ->merge(['type' => 'radio'])
        ->class([
            'form-radio transition ease-in-out duration-100',
            $roundedClasses,
            $colorClasses,
            $sizeClasses,
            'focus:invalidated:ring-negative-500 invalidated:ring-negative-500 invalidated:border-negative-400 invalidated:text-negative-600',
            'focus:invalidated:border-negative-400 dark:focus:invalidated:border-negative-600 dark:invalidated:ring-negative-600',
            'dark:invalidated:border-negative-600 dark:invalidated:bg-negative-700 dark:checked:invalidated:bg-negative-700',
            'dark:focus:invalidated:ring-offset-secondary-800 dark:checked:invalidated:border-negative-700',
        ])
    }} />
</x-dynamic-component>

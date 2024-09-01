<x-dynamic-component
    :component="WireUi::component('text-field')"
    padding="none"
    :config="$config"
    :attributes="$wrapper"
    :with-error-icon="false"
>
    @include('wireui-wrapper::components.slots', [
        'except' => ['prepend', 'append'],
    ])

    <textarea
        {{ $input
            ->merge([
                'type' => 'text',
                'autocomplete' => 'off',
                'placeholder' => ' ',
                'rows' => $rows,
                'cols' => $cols,
            ])
            ->class([
                'bg-transparent block !border-0 text-gray-900 dark:text-gray-400',
                'pl-3 pr-2.5 py-2 !outline-0 !ring-0 sm:text-sm sm:leading-normal',
                'placeholder:text-gray-400 dark:placeholder:text-gray-300',
                'invalidated:text-negative-800 invalidated:dark:text-negative-600',
                'invalidated:placeholder-negative-400 invalidated:dark:placeholder-negative-600/70',
                'w-full' => $cols === 'auto'
            ]) }}
    >{{ $slot }}</textarea>
</x-dynamic-component>

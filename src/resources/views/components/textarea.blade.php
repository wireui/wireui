<x-wrapper
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'x-data', 'class'])"
    :with-error-icon="false"
    padding="none"
>
    @include('wireui::components.wrapper.slots', [
        'except' => ['prepend', 'append'],
    ])

    <textarea
        {{ $attrs
            ->merge([
                'type' => 'text',
                'autocomplete' => 'off',
                'placeholder' => ' ',
                'rows' => 4,
            ])
            ->except(['wire:key', 'x-data', 'class'])
            ->class([
                'bg-transparent block w-full !border-0 text-gray-900 placeholder:text-gray-400',
                'pl-3 pr-2.5 py-2 !outline-0 !ring-0 sm:text-sm sm:leading-normal',
                'invalidated:text-negative-800 invalidated:dark:text-negative-600',
                'invalidated:placeholder-negative-400 invalidated:dark:placeholder-negative-600/70',
            ]) }}
    >{{ $slot }}</textarea>
</x-wrapper>

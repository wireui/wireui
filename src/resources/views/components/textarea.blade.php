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
                'rows' => $rows,
                'cols' => $cols,
            ])
            ->except(['wire:key', 'x-data', 'class'])
            ->class([
                'bg-transparent block !border-0 text-gray-900 placeholder:text-gray-400',
                'pl-3 pr-2.5 py-2 !outline-0 !ring-0 sm:text-sm sm:leading-normal',
                'invalidated:text-negative-800 invalidated:dark:text-negative-600',
                'invalidated:placeholder-negative-400 invalidated:dark:placeholder-negative-600/70'
                .($cols === 'auto' ? ' w-full' : ''), // if the consumer has set cols, then we shouldn't force the textarea full width
            ]) }}
    >{{ $slot }}</textarea>
</x-wrapper>

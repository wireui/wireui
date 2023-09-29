<x-wrapper
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'x-data', 'class'])"
    :with-error-icon="false"
>
    @include('wireui::components.wrapper.slots')

    <select {{ $attrs
        ->except(['class', 'wire:key', 'x-data'])
        ->class([
            'bg-transparent w-full p-0 border-0 outline-0 ring-0',
            'sm:text-sm sm:leading-6 text-gray-900',
            'invalidated:text-negative-800 invalidated:dark:text-negative-600',
            'invalidated:placeholder-negative-400 invalidated:dark:placeholder-negative-600/70',
        ]) }}
    >
        @if ($options->isNotEmpty())
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @forelse ($options as $key => $option)
                <option
                    value="{{ $getOptionValue($key, $option) }}"
                    @disabled(data_get($option, 'disabled', false))
                >
                    {{ $getOptionLabel($option) }}
                </option>
            @empty
                @unless ($hideEmptyMessage)
                    <option disabled>
                        {{ $emptyMessage ?? __('wireui::messages.empty_options') }}
                    </option>
                @endunless
            @endforelse
        @else {{ $slot }} @endif
    </select>
</x-wrapper>

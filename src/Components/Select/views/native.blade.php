<x-dynamic-component
    :component="WireUi::component('text-field')"
    :config="$config"
    :attributes="$wrapper"
    :with-error-icon="false"
>
    @include('wireui-wrapper::components.slots')

    <select {{ $input->class([
        'bg-transparent w-full p-0 !border-0 !outline-none !ring-0',
        'sm:text-sm sm:leading-6 text-gray-900 dark:text-gray-400',
        'placeholder:text-gray-400 dark:placeholder:text-gray-300',
        'invalidated:text-negative-800 invalidated:dark:text-negative-600',
        'invalidated:placeholder-negative-400 invalidated:dark:placeholder-negative-600/70',
    ]) }}>
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
                        {{ $emptyMessage ?? trans('wireui::messages.empty_options') }}
                    </option>
                @endunless
            @endforelse
        @else {{ $slot }} @endif
    </select>
</x-dynamic-component>

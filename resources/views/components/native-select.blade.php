@php
    $hasError = !$errorless && $name && $errors->has($name);
@endphp

<div class="w-full @if($disabled) opacity-60 @endif">
    @if ($label)
        <x-dynamic-component
            :component="WireUi::component('label')"
            class="mb-1"
            :label="$label"
            :has-error="$hasError"
            :for="$id"
        />
    @endif

    <select {{ $attributes->class([
        $defaultClasses(),
        $errorClasses() =>  $hasError,
        $colorClasses() => !$hasError,
    ]) }}>
        @if ($options->isNotEmpty())
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @forelse ($options as $key => $option)
                <option value="{{ $getOptionValue($key, $option) }}"
                    @if(data_get($option, 'disabled', false)) disabled @endif>
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

    @if ($hint)
        <label @if ($id) for="{{ $id }}" @endif class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">
            {{ $hint }}
        </label>
    @endif

    @if ($name && !$errorless)
        <x-dynamic-component
            :component="WireUi::component('error')"
            :name="$name"
        />
    @endif
</div>

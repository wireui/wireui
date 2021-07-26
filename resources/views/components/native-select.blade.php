<div class="@if($disabled) opacity-60 @endif">
    @if ($label)
        <x-label class="mb-1" :label="$label" :has-error="$errors->has($name)" :for="$id" />
    @endif

    <select {{ $attributes->class([
        $defaultClasses(),
        $errorClasses() =>  $errors->has($name),
        $colorClasses() => !$errors->has($name),
    ]) }}>
        @if ($options !== null)
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @forelse ($options as $key => $option)
                <option value="{{ $getOptionValue($key, $option) }}"
                    @if(data_get($option, 'disabled', false)) disabled @endif>
                    {{ $getOptionLabel($key, $option) }}
                </option>
            @empty
                <option disabled>
                    @lang('wireui::messages.empty_options')
                </option>
            @endforelse
        @else {{ $slot }} @endif
    </select>

    @if ($name)
        <x-error :name="$name" />
    @endif
</div>

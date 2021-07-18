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

            @forelse ($options as $option)
                <option value="{{ data_get($option, $optionValue) }}"
                    @if(data_get($option, 'disabled', false)) disabled @endif>
                    {{ data_get($option, $optionLabel) }}
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

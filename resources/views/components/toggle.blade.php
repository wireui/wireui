<label class="form-toggle @if ($disabled) opacity-60 @endif"
    for="{{ $id }}"
    tabindex="0">
    <div class="flex items-center {{ $errors->has($name) ? 'text-negative-600':'' }}">
        @if ($leftLabel)
            <x-label class="mr-2" :label="$leftLabel" />
        @endif

        <div class="relative">
            <input {{ $attributes }} type="checkbox" class="hidden" @if ($readonly) disabled @endif />
            <div class="form-toggle-background {{ $backgroundClasses() }} {{ $errors->has($name) ? 'bg-negative-500':'' }}"></div>
            <div class="form-toggle-circle {{ $circleClasses() }}"></div>
        </div>

        @if ($label)
            <x-label class="ml-2" :label="$label" />
        @endif
    </div>

    @if ($name)
        <x-error :name="$name" />
    @endif
</label>

<label for="{{ $id }}" tabindex="0" class="form-toggle @if($disabled) opacity-60 @endif">
    <div class="flex items-center {{ $errors->has($name) ? 'text-red-600':'' }}">
        @if ($leftLabel)
            <span class="mr-2 text-sm font-medium">{{ $leftLabel }}</span>
        @endif
        <div class="relative">
            <input {{ $attributes }} type="checkbox" class="hidden" @if($readonly) disabled @endif />
            <div class="form-toggle-background {{ $backgroundClasses() }} {{ $errors->has($name) ? 'bg-red-500':'' }}"></div>
            <div class="form-toggle-circle {{ $circleClasses() }}"></div>
        </div>
        @if ($label)
            <span class="ml-2 text-sm font-medium">{{ $label }}</span>
        @endif
    </div>

    @if ($name)
        <x-error :name="$name" />
    @endif
</label>

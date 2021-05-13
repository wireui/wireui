<div>
    <label for="{{ $id }}" class="flex items-center {{ $errors->has($name) ? 'text-red-600':'' }}">
        @if ($leftLabel)
            <span class="mr-2 text-sm font-medium">{{ $leftLabel }}</span>
        @endif
        <input {{ $attributes->class([
                'block sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none',
                'w-5 h-5' => $md,
                'w-6 h-6' => $lg,
                'ring-red-500 ring-2 ring-offset-2 border-red-400' => $errors->has($name)
            ]) }}
            type="checkbox"
        />
        @if ($label)
            <span class="ml-2 text-sm font-medium">{{ $label }}</span>
        @endif
    </label>

    @if ($name)
        <x-error :name="$name" />
    @endif
</div>

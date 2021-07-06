<div>
    <label for="{{ $id }}" class="flex items-center {{ $errors->has($name) ? 'text-negative-600':'' }}">
        @if ($leftLabel)
            <x-label class="mr-2" :label="$leftLabel" />
        @endif

        <input {{ $attributes->class([
            'block sm:text-sm rounded-sm transition ease-in-out duration-100 focus:outline-none',
            'border-secondary-300 text-primary-600 checked:bg-primary-600 focus:ring-primary-600',
            'dark:border-secondary-600 dark:text-secondary-600 dark:focus:ring-0 dark:bg-secondary-600',
            'w-5 h-5' => $md,
            'w-6 h-6' => $lg,
            'ring-negative-500 ring-2 ring-offset-2 border-negative-400' => $errors->has($name)
            ])->merge(['type' => 'checkbox']) }}
        />

        @if ($label)
            <x-label class="ml-2" :label="$label" />
        @endif
    </label>

    @if ($name)
        <x-error :name="$name" />
    @endif
</div>

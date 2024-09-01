<label {{ $attributes->class([
    'block text-sm font-medium disabled:opacity-60',
    'text-gray-700 dark:text-gray-400',
    'invalidated:text-negative-600 dark:invalidated:text-negative-700',
]) }}>
    {{ $text ?? $slot }}
</label>

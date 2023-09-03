<label {{ $attributes->class([
    'block text-sm font-medium disabled:opacity-60',
    'text-gray-700 dark:text-gray-400',
    'invalidated:text-negative-600 dark:invalidated:text-negative-700',
    'validated:text-positive-600 dark:validated:text-positive-700',
]) }}>
    {{ $label ?? $slot }}
</label>

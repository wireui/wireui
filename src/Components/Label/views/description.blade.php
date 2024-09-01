<label {{ $attributes->class([
    'text-sm text-gray-500 dark:text-gray-400',
    'invalidated:text-negative-500 invalidated:dark:text-negative-700',
]) }}>
    {{ $text ?? $slot }}
</label>

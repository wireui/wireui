<label {{ $attributes->class([
        'block text-sm font-medium',
        'text-negative-600'  =>  $hasError,
        'text-secondary-700 dark:text-gray-400' => !$hasError,
    ]) }}>
    {{ $label ?? $slot }}
</label>

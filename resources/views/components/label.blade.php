<label {{ $attributes->class([
        'block text-sm font-medium',
        'text-negative-600'  =>  $hasError,
        'text-secondary-700' => !$hasError,
    ]) }}>
    {{ $label ?? $slot }}
</label>

<label {{ $attributes->class([
        'block text-sm font-medium',
        'text-red-600'  =>  $hasError,
        'text-gray-700' => !$hasError,
    ]) }}>
    {{ $label ?? $slot }}
</label>

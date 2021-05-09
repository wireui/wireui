<label {{ $attributes->class([
        'block text-sm font-medium',
        'text-red-700'  =>  $hasError,
        'text-gray-700' => !$hasError,
    ]) }}>
    {{ $label ?? $slot }}
</label>

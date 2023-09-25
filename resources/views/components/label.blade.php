<label {{ $attributes->class([
        'block text-sm font-medium',
        'text-negative-600'  => $hasError,
        'opacity-60'         => $attributes->get('disabled'),
        'text-gray-700 dark:text-gray-400' => !$hasError,
    ]) }}>
    @if($label) {{ $label }} @else {!! $slot !!} @endif
</label>

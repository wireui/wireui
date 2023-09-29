@php
    $separatorClasses = Arr::toCssClasses([
        'border-t border-secondary-200 dark:border-secondary-600' => $separator,
    ]);

    $labelClasses = Arr::toCssClasses([
        'block pl-2 pt-2 pb-1 text-xs text-secondary-600 sticky top-0 bg-white',
        'dark:bg-secondary-800 dark:text-secondary-400',
    ]);
@endphp

<div class="{{ $separatorClasses }}">
    <h6 {{ $attributes->class($labelClasses) }}>
        {{ $label }}
    </h6>

    {{ $slot }}
</div>

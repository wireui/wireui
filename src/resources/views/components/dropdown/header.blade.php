<div class="@if($separator) border-t border-secondary-200 dark:border-secondary-600 @endif">
    <h6 {{ $attributes->class($classes) }}>
        {{ $label }}
    </h6>

    {{ $slot }}
</div>

<div class="@if($separator) border-t border-secondary-200 dark:border-secondary-600 @endif">
    <h6 {{ $attributes->merge(['class' => $classes]) }}>
        {{ $label }}
    </h6>

    {{ $slot }}
</div>

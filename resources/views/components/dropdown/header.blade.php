<div class="@if($separator) border-t border-secondary-200 @endif">
    <h6 {{ $attributes->merge(['class' => $classes]) }}>
        {{ $label }}
    </h6>

    {{ $slot }}
</div>

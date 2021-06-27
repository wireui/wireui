<div class="@if($separator) border-t border-secondary-200 @endif">
    <h6 {{ $attributes->merge(['class' => 'block pl-2 pt-2 pb-1 text-xs text-secondary-600 sticky top-0 bg-white']) }}>
        {{ $label }}
    </h6>

    {{ $slot }}
</div>

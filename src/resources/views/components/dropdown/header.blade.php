<div class="{{ $getSeparatorClasses() }}">
    <h6 {{ $attributes->class($getLabelClasses()) }}>
        {{ $label }}
    </h6>

    {{ $slot }}
</div>

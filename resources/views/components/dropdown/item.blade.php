@if ($separator)
    <div class="w-full my-1 border-t border-secondary-200 dark:border-secondary-600"></div>
@endif

<a {{ $attributes->merge(['class' => $getClasses()]) }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            class="w-5 h-5 mr-2"
        />
    @endif

    {{ $label ?? $slot }}
</a>

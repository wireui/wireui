@if ($separator)
    <div class="w-full my-1 border-t border-secondary-200 dark:border-secondary-600"></div>
@endif

<a {{ $attributes->class([
    'text-secondary-600 px-4 py-2 text-sm flex items-center cursor-pointer rounded-md',
    'transition-colors duration-150 hover:text-secondary-900 hover:bg-secondary-100',
    'dark:text-secondary-400 dark:hover:bg-secondary-700',
]) }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            class="w-5 h-5 mr-2"
        />
    @endif

    {{ $label ?? $slot }}
</a>

<li {{ $attributes->class([
        'py-2 px-3 focus:outline-none transition-colors ease-in-out duration-50 relative group',
        'text-secondary-600 dark:text-secondary-400',
        'cursor-pointer focus:bg-primary-100 focus:text-primary-800 hover:text-white' => !($readonly || $disabled),
        'dark:focus:bg-secondary-700' => !($readonly || $disabled),
        'opacity-60 cursor-not-allowed' => $disabled
    ])->merge([
        'data-label' => $label,
        'data-value' => $value,
    ]) }}
    @unless($readonly || $disabled)
        tabindex="0"
        x-on:click="select('{{ $value }}')"
        x-on:keydown.enter="select('{{ $value }}')"
    @endunless
    :class="{
        'font-semibold': isSelected('{{ $value }}'),
        @if (!($readonly || $disabled))
            'hover:bg-negative-500 dark:hover:text-secondary-100': isSelected('{{ $value }}'),
            'hover:bg-primary-500 dark:hover:bg-secondary-700': !isSelected('{{ $value }}'),
        @endif
    }">
    {!! $label ?? $slot !!}

    <div class="absolute inset-y-0 right-0 flex items-center pr-4"
        x-show="isSelected('{{ $value }}')">
        <x-dynamic-component
            :component="WireUiComponent::resolve('icon')"
            name="check"
            class="w-5 h-5 text-primary-600 dark:text-secondary-500 group-hover:text-white"
        />
    </div>
</li>

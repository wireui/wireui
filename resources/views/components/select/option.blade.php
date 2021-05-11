<li {{ $attributes->class([
        'py-2 px-3 focus:outline-none transition-colors ease-in-out duration-50 relative group',
        'cursor-pointer focus:bg-indigo-100 focus:text-indigo-800 hover:bg-indigo-600 hover:text-white' => !($readonly || $disabled),
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
    :class="{ 'font-semibold': isSelected('{{ $value }}') }">
    {{ $label ?? $slot }}

    <div class="absolute inset-y-0 right-0 flex items-center pr-4"
        x-show="isSelected('{{ $value }}')">
        <x-icon name="check" class="w-5 h-5 text-indigo-600 group-hover:text-white" />
    </div>
</li>

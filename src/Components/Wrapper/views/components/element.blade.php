<input
    {{ $attributes->merge([
        'type'         => 'text',
        'autocomplete' => 'off',
        'placeholder'  => ' ',
    ])->class([
        'bg-transparent block w-full border-0 text-gray-900 dark:text-gray-400',
        'p-0 outline-none outline-hidden ring-0 sm:text-sm sm:leading-6',
        'focus:ring-0 focus:border-0',
        'placeholder:text-gray-400 dark:placeholder:text-gray-300',
        'invalidated:text-negative-800 dark:invalidated:text-negative-600',
        'invalidated:placeholder-negative-400 dark:invalidated:placeholder-negative-600/70',
    ]) }}
/>

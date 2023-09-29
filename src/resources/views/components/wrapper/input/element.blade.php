<input
    {{ $attributes->merge([
        'type'         => 'text',
        'autocomplete' => 'off',
        'placeholder'  => ' ',
    ])->class([
        'bg-transparent block w-full border-0 text-gray-900',
        'p-0 outline-0 ring-0 sm:text-sm sm:leading-6',
        'placeholder:text-gray-400',
        'invalidated:text-negative-800 invalidated:dark:text-negative-600',
        'invalidated:placeholder-negative-400 invalidated:dark:placeholder-negative-600/70',
    ]) }}
/>

<div class="w-full flex flex-col {{ $shadow }} {{ $rounded }} {{ $color }} {{ $cardClasses }}">
    @if ($header)
        {{ $header }}
    @elseif ($title || $action)
        <div class="px-4 py-2.5 flex justify-between items-center border-b dark:border-gray-600 ">
            <h3 class="font-medium whitespace-normal text-md text-secondary-700 dark:text-secondary-400">{{ $title }}</h3>

            @if ($action)
                {{ $action }}
            @endif
        </div>
    @endif

    <div {{ $attributes->merge(['class' => "{$padding} text-secondary-700 dark:text-secondary-400 grow"]) }}>
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="px-4 py-4 sm:px-6 bg-secondary-50 rounded-t-none dark:bg-secondary-800
                    border-t dark:border-secondary-600 {{ $rounded }}">
            {{ $footer }}
        </div>
    @endif
</div>

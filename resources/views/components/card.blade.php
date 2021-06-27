<div class="w-full flex flex-col {{ $divider }} {{ $shadow }} {{ $rounded }} {{ $color }} {{ $cardClasses }}">
    @if ($header)
        {{ $header }}
    @elseif ($title || $action)
        <div class="px-4 py-2.5 flex justify-between items-center">
            <h3 class="text-md font-medium text-secondary-700">{{ $title }}</h3>

            @if ($action)
                {{ $action }}
            @endif
        </div>
    @endif

    <div {{ $attributes->merge(['class' => "{$padding} flex-grow"]) }}>
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="px-4 py-4 sm:px-6 bg-secondary-50 rounded-t-none {{ $rounded }}">
            {{ $footer }}
        </div>
    @endif
</div>

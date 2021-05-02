<div class="w-full divide-y divide-gray-200 {{ $shadow }} {{ $rounded }} {{ $color }}">
    @if ($header)
        {{ $header }}
    @elseif ($title || $action)
        <div class="px-4 py-2.5 flex justify-between items-center">
            <h2 class="text-md text-gray-500 font-semibold uppercase">{{ $title }}</h2>

            @if ($action)
                {{ $action }}
            @endif
        </div>
    @endif

    <div {{ $attributes->merge(['class' => "{$padding}"]) }}>
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="px-4 py-4 sm:px-6 bg-gray-50 rounded-t-none {{ $rounded }}">
            {{ $footer }}
        </div>
    @endif
</div>

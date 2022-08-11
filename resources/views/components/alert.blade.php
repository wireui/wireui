<div class="{{ $alertClasses }}">
    <div class="flex">
        @if ($icon)
            <div class="flex-shrink-0">
                <x-dynamic-component
                    :component="WireUi::component('icon')"
                    :name="$icon"
                    class="h-5 w-5 shrink-0 {{ $subjectColor }}"
                />
            </div>
        @endif

        <div class="ml-3">
            <h3 class="text-sm font-semibold {{ $subjectColor }}">{{ $title }}</h3>
            <div class="@if(!is_null($title)) mt-2 @endif text-sm {{ $subjectColor }}">
                <p>{{ $message ?? $slot }}</p>
            </div>
            @if($actions)
                <div class="mt-4">
                    <div class="-mx-2 -my-1.5 flex">
                        {{ $actions }}
                    </div>
                </div>
            @endif
        </div>

        @if ($dismissible)
            {{ $dismissible }}
        @endif
    </div>
</div>

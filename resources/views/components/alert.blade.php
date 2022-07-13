<div class="{{ $alertClasses }}">
    <div class="flex">
        @if($icon)
            <div class="flex-shrink-0">
                <x-icon name="{{ $icon }}" class="h-5 w-5 {{ $subjectColor }}" />
            </div>
        @endif
        <div class="ml-3">
            <h3 class="text-sm font-semibold {{ $subjectColor }}">{{ $heading }}</h3>
            <div class="@if(!is_null($heading)) mt-2 @endif text-sm {{ $subjectColor }}">
                <p>{{ $text ?? $slot }}</p>
            </div>
            @if($actions)
                <div class="mt-4">
                    <div class="-mx-2 -my-1.5 flex">
                        {{ $actions }}
                    </div>
                </div>
            @endif
        </div>
        @if($dismiss)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" wire:click="dismiss" class="inline-flex {{ $backgroundColor }} rounded-md p-1.5 {{ $subjectColor }} focus:outline-none focus:ring-2 focus:ring-offset-2">
                        <span class="sr-only">Dismiss</span>
                        <x-icon name="x" class="h-5 w-5" />
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

@php
    $hasError = false;
    if ($name) { $hasError = $errors->has($name); }
@endphp

<div class="@if($disabled) opacity-60 @endif">
    @if ($label || $cornerHint)
        <div class="flex {{ !$label && $cornerHint ? 'justify-end' : 'justify-between' }}">
            @if ($label)
                <label class="block text-sm font-medium {{ $hasError ? 'text-red-700' : 'text-gray-700' }}"
                    @if($id) for="{{ $id }}" @endif>
                    {{ $label }}
                </label>
            @endif

            @if ($cornerHint)
                <span class="text-sm text-gray-500">{{ $cornerHint }}</span>
            @endif
        </div>
    @endif

    <div class="mt-1 relative rounded-md shadow-sm">
        @if ($prefix || $icon)
            <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none
                {{ $hasError ? 'text-red-500' : 'text-gray-400' }}">
                @if ($icon)
                    <x-wireui::icon :name="$icon" class="h-5 w-5" />
                @elseif($prefix)
                    <span class="w-5 flex items-center justify-center font-semibold">
                        {{ $prefix }}
                    </span>
                @endif
            </div>
        @elseif($prepend)
            {{ $prepend }}
        @endif

        <input {{ $attributes->merge([
            'class'        => $getInputClasses($hasError),
            'type'         => 'text',
            'autocomplete' => 'off',
        ]) }} />

        @if ($suffix || $rightIcon || ($hasError && !$append))
            <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none
                {{ $hasError ? 'text-red-500' : 'text-gray-400' }}">
                @if ($rightIcon)
                    <x-wireui::icon :name="$rightIcon" class="h-5 w-5" />
                @elseif($suffix)
                    <span class="w-5 flex items-center justify-center font-semibold">
                        {{ $suffix }}
                    </span>
                @elseif($hasError)
                    <x-wireui::icon name="exclamation-circle" class="h-5 w-5" />
                @endif
            </div>
        @elseif($append)
            {{ $append }}
        @endif
    </div>

    @if (!$hasError && $hint)
        <p class="mt-2 text-sm text-gray-500">{{ $hint }}</p>
    @endif

    @if ($name)
        <x-wireui::error :name="$name" />
    @endif
</div>

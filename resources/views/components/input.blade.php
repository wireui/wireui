@php
    $hasError = !$errorless && $name && $errors->has($name);
@endphp

<div class="@if($disabled) opacity-60 @endif">
    @if ($label || $cornerHint)
        <div class="flex {{ !$label && $cornerHint ? 'justify-end' : 'justify-between items-end' }} mb-1">
            @if ($label)
                <x-dynamic-component
                    :component="WireUi::component('label')"
                    :label="$label"
                    :has-error="$hasError"
                    :for="$id"
                />
            @endif

            @if ($cornerHint)
                <x-dynamic-component
                    :component="WireUi::component('label')"
                    :label="$cornerHint"
                    :has-error="$hasError"
                    :for="$id"
                />
            @endif
        </div>
    @endif

    <div class="relative rounded-md @unless($shadowless) shadow-sm @endunless">
        @if ($prefix || $icon)
            <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none
                {{ $hasError ? 'text-negative-500' : 'text-secondary-400' }}">
                @if ($icon)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$icon"
                        class="w-5 h-5"
                    />
                @elseif($prefix)
                    <span class="flex items-center self-center pl-1">
                        {{ $prefix }}
                    </span>
                @endif
            </div>
        @elseif($prepend)
            {{ $prepend }}
        @endif

        <input {{ $attributes->class([
                $getInputClasses($hasError),
            ])->merge([
                'type'         => 'text',
                'autocomplete' => 'off',
            ]) }} />

        @if ($suffix || $rightIcon || ($hasError && !$append) || $spinner)
            <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center pointer-events-none
                {{ $hasError ? 'text-negative-500' : 'text-secondary-400' }}">

                @if ($rightIcon)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$rightIcon"
                        class="w-5 h-5"
                        :wire:loading.remove="(bool) $spinner"
                    />
                @elseif ($suffix)
                    <span class="flex items-center justify-center pr-1">
                        {{ $suffix }}
                    </span>
                @elseif($spinner)
                    <svg class="animate-spin shrink-0 w-5 h-5 none"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        @if (preg_replace('/[^a-zA-Z]+/', '', $spinner))
                            wire:target="{{ $spinner }}"
                        @endif
                        wire:loading.block
                    >
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                @elseif ($hasError)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        name="exclamation-circle"
                        class="w-5 h-5"
                    />
                @endif
            </div>
        @elseif ($append)
            {{ $append }}
        @endif
    </div>

    @if (!$hasError && $hint)
        <label @if ($id) for="{{ $id }}" @endif class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">
            {{ $hint }}
        </label>
    @endif

    @if ($name && !$errorless)
        <x-dynamic-component
            :component="WireUi::component('error')"
            :name="$name"
        />
    @endif
</div>

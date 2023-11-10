@php
    $hasError = !$errorless && $name && $errors->has($name);
@endphp

<div>
    <label for="{{ $id }}" class="flex items-center {{ $hasError ? 'text-negative-600' : '' }}">
        <div class="relative flex items-start">
        @if ($leftLabel)
            <div class="mr-2 text-sm text-right">
                <x-dynamic-component
                    :component="WireUi::component('label')"
                    class=""
                    :for="$id"
                    :label="$leftLabel"
                    :has-error="$hasError"
                />
                @if($description)
                    <div id="{{ $id }} . comments-description" class="text-gray-500">{{ $description }}</div>
                @endif
            </div>
        @endif

        <div class="flex items-center h-5">
            <input {{ $attributes->class([
                    $getClasses($hasError),
                ])->merge([
                    'type'  => 'radio',
                ]) }} />
        </div>

        @if ($label)
            <div class="ml-2 text-sm">
                <x-dynamic-component
                    :component="WireUi::component('label')"
                    class=""
                    :for="$id"
                    :label="$label"
                    :has-error="$hasError"
                />
                @if($description)
                    <div id="{{ $id }} . comments-description" class="text-gray-500">{{ $description }}</div>
                @endif
            </div>
        @endif
        </div>
    </label>

    @if ($name && !$errorless)
        <x-dynamic-component
            :component="WireUi::component('error')"
            :name="$name"
        />
    @endif
</div>

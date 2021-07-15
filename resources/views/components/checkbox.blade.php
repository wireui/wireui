<div>
    <label for="{{ $id }}" class="flex items-center {{ $errors->has($name) ? 'text-negative-600':'' }}">
        @if ($leftLabel)
            <x-label class="mr-2" :label="$leftLabel" :has-error="$errors->has($name)" />
        @endif

        <input {{ $attributes->class($getClasses($errors->has($name)))->merge(['type' => 'checkbox']) }} />


        @if ($label)
            <x-label class="ml-2" :label="$label" :has-error="$errors->has($name)" />
        @endif
    </label>

    @if ($name)
        <x-error :name="$name" />
    @endif
</div>

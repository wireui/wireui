<div>
    <label for="{{ $id }}" class="flex items-center {{ $errors->has($name) ? 'text-negative-600':'' }}">
        @if ($leftLabel)
            <x-label class="mr-2" :for="$id" :label="$leftLabel" :has-error="$errors->has($name)" />
        @endif

        <input {{ $attributes->merge([
            'type'  => 'checkbox',
            'class' => $getClasses($errors->has($name))
        ]) }} />


        @if ($label)
            <x-label class="ml-2" :for="$id" :label="$label" :has-error="$errors->has($name)" />
        @endif
    </label>

    @if ($name)
        <x-error :name="$name" />
    @endif
</div>

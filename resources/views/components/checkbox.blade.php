<div>
    <label for="{{ $id }}" class="flex items-center {{ $errors->has($name) ? 'text-negative-600':'' }}">
        @if ($leftLabel)
            <x-dynamic-component
                :component="WireUiComponent::resolve('label')"
                class="mr-2"
                :for="$id"
                :label="$leftLabel"
                :has-error="$errors->has($name)"
            />
        @endif

        <input {{ $attributes->merge([
            'type'  => 'checkbox',
            'class' => $getClasses($errors->has($name))
        ]) }} />

        @if ($label)
            <x-dynamic-component
                :component="WireUiComponent::resolve('label')"
                class="ml-2"
                :for="$id"
                :label="$label"
                :has-error="$errors->has($name)"
            />
        @endif
    </label>

    @if ($name)
        <x-dynamic-component
            :component="WireUiComponent::resolve('error')"
            :name="$name"
        />
    @endif
</div>

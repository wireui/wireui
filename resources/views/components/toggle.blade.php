<div>
    <div class="flex items-center">
        @if ($leftLabel)
            <x-dynamic-component
                :component="WireUiComponent::resolve('label')"
                :for="$id"
                class="mr-2"
                :label="$leftLabel"
                :has-error="$errors->has($name)"
            />
        @endif

        <div class="relative flex items-center select-none">
            <input {{ $attributes->merge([
                    'name'  => $name,
                    'id'    => $id,
                    'class' => $circleClasses(),
                ]) }}
                type="checkbox"
            />

            <label for="{{ $id }}" class="{{ $backgroundClasses($errors->has($name)) }}"></label>
        </div>

        @if ($label)
            <x-dynamic-component
                :component="WireUiComponent::resolve('label')"
                :for="$id"
                class="ml-2"
                :label="$label"
                :has-error="$errors->has($name)"
            />
        @endif
    </div>

    @if ($name)
        <x-dynamic-component
            :component="WireUiComponent::resolve('error')"
            :name="$name"
        />
    @endif
</div>

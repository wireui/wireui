<div>
    <div class="flex items-center">
        @if ($leftLabel)
            <x-dynamic-component
                :component="WireUi::component('label')"
                :for="$id"
                class="mr-2"
                :label="$leftLabel"
                :has-error="$errors->has($name)"
            />
        @endif

        <label for="{{ $id }}" tabindex="-1" class="group relative flex items-center select-none">
            <input {{ $attributes->merge([
                    'name'  => $name,
                    'id'    => $id,
                    'class' => $circleClasses(),
                ]) }}
                type="checkbox"
            />

            <div class="{{ $backgroundClasses($errors->has($name)) }}"></div>
        </label>

        @if ($label)
            <x-dynamic-component
                :component="WireUi::component('label')"
                :for="$id"
                class="ml-2"
                :label="$label"
                :has-error="$errors->has($name)"
            />
        @endif
    </div>

    @if ($name)
        <x-dynamic-component
            :component="WireUi::component('error')"
            :name="$name"
        />
    @endif
</div>

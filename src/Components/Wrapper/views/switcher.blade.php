<div
    @attributes([
        'with-validation-colors' => $withValidationColors,
        'group-invalidated'      => $invalidated,
        'aria-disabled'          => $disabled,
        'aria-readonly'          => $readonly,
    ])
    {{ $attributes
        ->only(['class', 'wire:key', 'form-wrapper', 'x-data', 'x-props'])
        ->merge(['form-wrapper' => $id ?: 'true'])
        ->class([
            'aria-disabled:pointer-events-none aria-disabled:select-none',
            'aria-disabled:opacity-60 aria-disabled:cursor-not-allowed',
            'aria-readonly:pointer-events-none aria-readonly:select-none',
            'relative',
        ]) }}
>
    <div class="flex items-center gap-x-2">
        @if ($leftLabel)
            <x-dynamic-component
                :component="WireUi::component('label')"
                :attributes="WireUi::extractAttributes($leftLabel)"
                :for="$id"
            >
                {{ $leftLabel }}
            </x-dynamic-component>
        @endif

        {{ $slot }}

        @if ($label)
            <x-dynamic-component
                :component="WireUi::component('label')"
                :attributes="WireUi::extractAttributes($label)"
                :for="$id"
            >
                {{ $label }}
            </x-dynamic-component>
        @endif
    </div>

    @if ($description && !$invalidated)
        <x-dynamic-component
            :component="WireUi::component('description')"
            :for="$id"
            class="mt-2"
            name="form.wrapper.description"
        >
            {{ $description }}
        </x-dynamic-component>
    @elseif (!$errorless && $invalidated)
        <x-dynamic-component
            :component="WireUi::component('error')"
            :for="$id"
            class="mt-2"
            :name="$name"
        >
            {{ $error }}
        </x-dynamic-component>
    @endif
</div>

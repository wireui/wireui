<div
    @attributes([
        'with-validation-colors' => $withValidationColors,
        'group-invalidated'      => $invalidated,
        'aria-disabled'          => $disabled,
        'aria-readonly'          => $readonly,
    ])
    {{ $attributes
        ->merge(['form-wrapper' => $id ?: 'true'])
        ->class([
            'aria-disabled:pointer-events-none aria-disabled:select-none',
            'aria-disabled:opacity-60 aria-disabled:cursor-not-allowed',
            'aria-readonly:pointer-events-none aria-readonly:select-none',
            'relative',
        ])
        ->only(['wire:key', 'form-wrapper', 'x-data', 'class', 'x-props']) }}
>
    <div class="flex items-center gap-x-2">
        @if ($label)
            <x-wireui::form.label
                :attributes="WireUi::extractAttributes($label)"
                :for="$id"
            >
                {{ $label }}
            </x-wireui::form.label>
        @endif

        {{ $slot }}

        @if ($rightLabel)
            <x-wireui::form.label
                :attributes="WireUi::extractAttributes($rightLabel)"
                :for="$id"
            >
                {{ $rightLabel }}
            </x-wireui::form.label>
        @endif
    </div>

    @if ($description && !$invalidated)
        <x-wireui::form.description
            class="mt-2"
            :for="$id"
            name="form.wrapper.description"
        >
            {{ $description }}
        </x-wireui::form.description>
    @elseif (!$errorless && $invalidated)
        <x-wireui::form.error
            class="mt-2"
            :for="$id"
            :message="$errors->first($name)"
            name="form.wrapper.error"
        />
    @endif
</div>

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
    @if ($label || $corner)
        <div
            @class([
                'flex mb-1',
                'justify-end'               => !$label,
                'justify-between items-end' =>  $label,
            ])
            name="form.wrapper.header"
        >
            @if ($label)
                <x-wireui::form.label
                    :attributes="WireUi::extractAttributes($label)"
                    :for="$id"
                >
                    {{ $label }}
                </x-wireui::form.label>
            @endif

            @if ($corner)
                <x-wireui::form.label
                    :attributes="WireUi::extractAttributes($corner)"
                    :for="$id"
                >
                    {{ $corner }}
                </x-wireui::form.label>
            @endif
        </div>
    @endif

    <label
        {{ $attributes
            ->except(['wire:key', 'form-wrapper', 'x-data', 'class'])
            ->merge(['for' => $id])
            ->class([
                'relative flex gap-x-2 items-center rounded-md shadow-sm',
                'ring-1 ring-inset ring-gray-300',
                'focus-within:ring-2 focus-within:ring-primary-600',
                'transition-all ease-in-out duration-150',

                $padding =>  $padding,
                'pl-3'   => !$padding && !isset($prepend),
                'pr-3'   => !$padding && !isset($append),
                'py-2'   => !$padding && !isset($prepend) && !isset($append),
                'h-10'   => isset($prepend) || isset($append),

                'invalidated:bg-negative-50 invalidated:ring-negative-500 invalidated:dark:ring-negative-700',
                'invalidated:dark:bg-negative-700/10 invalidated:dark:ring-negative-600',
            ])
        }}
        name="form.wrapper.container"
    >
        @if (!isset($prepend) && ($prefix || $icon))
            <div
                name="form.wrapper.container.prefix"
                @class([
                    'text-gray-500 pointer-events-none select-none flex items-center whitespace-nowrap',
                    'input-focus:text-primary-500 invalidated:input-focus:text-negative-500',
                    'invalidated:text-negative-500',
                ])
            >
                @if ($icon)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$icon"
                        class="w-4.5 h-4.5"
                    />
                @elseif($prefix)
                    <span {{ WireUi::extractAttributes($prefix) }}>
                        {{ $prefix }}
                    </span>
                @endif
            </div>
        @elseif (isset($prepend))
            <div
                name="form.wrapper.container.prepend"
                {{ $prepend->attributes->class([
                    'group/prepend wrapper-prepend-slot',
                    'flex h-full py-0.5 pl-0.5',
                ]) }}
            >
                {{ $prepend }}
            </div>
        @endif

        {{ $slot }}

        @if (!isset($append) && ($rightIcon || $suffix || $withErrorIcon))
            <div
                name="form.wrapper.container.suffix"
                @class([
                    'text-gray-500 pointer-events-none select-none flex items-center whitespace-nowrap',
                    'input-focus:text-primary-500 invalidated:input-focus:text-negative-500',
                    'invalidated:text-negative-500',
                ])
            >
                @if ($rightIcon)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$rightIcon"
                        class="w-4.5 h-4.5"
                    />
                @elseif($suffix)
                    <span {{ WireUi::extractAttributes($suffix) }}>
                        {{ $suffix }}
                    </span>
                @elseif($withErrorIcon)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        name="exclamation-circle"
                        class="hidden invalidated:block w-4.5 h-4.5"
                    />
                @endif
            </div>
        @elseif(isset($append))
            <div
                name="form.wrapper.container.append"
                {{ $append->attributes->class([
                    'group/append wrapper-append-slot',
                    'flex h-full py-0.5 pr-0.5',
                ]) }}
            >
                {{ $append }}
            </div>
        @endif
    </label>

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
        />
    @endif

    @isset($after)
        <div {{ $after->attributes }}>
            {{ $after }}
        </div>
    @endisset
</div>

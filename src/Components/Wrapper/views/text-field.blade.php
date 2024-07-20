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
            'aria-disabled:pointer-events-none aria-disabled:select-none aria-disabled:opacity-60',
            'aria-readonly:pointer-events-none aria-readonly:select-none',
            'w-full relative',
        ]) }}
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
                <x-dynamic-component
                    :component="WireUi::component('label')"
                    :attributes="WireUi::extractAttributes($label)"
                    :for="$id"
                >
                    {{ $label }}
                </x-dynamic-component>
            @endif

            @if ($corner)
                <x-dynamic-component
                    :component="WireUi::component('label')"
                    :attributes="WireUi::extractAttributes($corner)"
                    :for="$id"
                >
                    {{ $corner }}
                </x-dynamic-component>
            @endif
        </div>
    @endif

    <label
        {{ $attributes
            ->whereStartsWith(['x-ref', 'x-on:', 'x-bind:', 'tabindex'])
            ->merge(['for' => $id])
            ->class([
                data_get($roundedClasses, 'input', ''),
                data_get($colorClasses, 'input', ''),
                $shadowClasses => !$shadowless,

                'bg-background-white dark:bg-background-dark',
                'relative flex justify-between gap-x-2 items-center',
                'transition-all ease-in-out duration-150',
                'ring-1 ring-inset ring-gray-300 focus-within:ring-2',
                'outline-0',

                '!bg-gray-100' => $disabled && !$invalidated,

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
                {{ WireUi::extractAttributes($prefix)->class([
                    'text-gray-400 pointer-events-none select-none flex items-center whitespace-nowrap',
                    'invalidated:text-negative-500 invalidated:input-focus:text-negative-500',
                    data_get($roundedClasses, 'prepend', ''),
                    data_get($colorClasses, 'prepend', ''),
                ]) }}
            >
                @if ($icon)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$icon"
                        class="w-4.5 h-4.5 text-current"
                    />
                @elseif($prefix)
                    {{ $prefix }}
                @endif
            </div>
        @elseif (isset($prepend))
            <div name="form.wrapper.container.prepend"
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
                {{ WireUi::extractAttributes($suffix)->class([
                    'text-gray-500 pointer-events-none select-none flex items-center whitespace-nowrap',
                    'invalidated:text-negative-500 invalidated:input-focus:text-negative-500',
                    data_get($roundedClasses, 'append', ''),
                    data_get($colorClasses, 'append', ''),
                ]) }}
            >
                @if ($rightIcon)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$rightIcon"
                        class="w-4.5 h-4.5"
                    />
                @elseif($suffix)
                    {{ $suffix }}
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
                    'group/append shrink-0 wrapper-append-slot',
                    'flex h-full py-0.5 pr-0.5',
                ]) }}
            >
                {{ $append }}
            </div>
        @endif
    </label>

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

    @isset($after)
        <div {{ $after->attributes }}>
            {{ $after }}
        </div>
    @endisset
</div>

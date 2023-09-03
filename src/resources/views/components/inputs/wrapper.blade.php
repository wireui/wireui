<div
    class="
        aria-disabled:pointer-events-none aria-disabled:select-none
        aria-disabled:opacity-60 aria-disabled:cursor-not-allowed
        aria-readonly:pointer-events-none aria-readonly:select-none
    "
    @attributes([
        'group-invalidated' => $invalidated,
        'group-validated'   => $validated,
        'aria-disabled'     => $disabled,
        'aria-readonly'     => $readonly,
        'form-wrapper'      => $id,
    ])
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
                    :attributes="WireUi::extractAttributes($label)"
                    :component="WireUi::component('label')"
                    :for="$id"
                >
                    {{ $label }}
                </x-dynamic-component>
            @endif

            @if ($corner)
                <x-dynamic-component
                    :attributes="WireUi::extractAttributes($corner)"
                    :component="WireUi::component('label')"
                    :for="$id"
                >
                    {{ $corner }}
                </x-dynamic-component>
            @endif
        </div>
    @endif

    <label
        {{ $attributes->merge(['for' => $id])->class([
            'relative flex gap-x-2 items-center rounded-md shadow-sm',
            'ring-1 ring-inset ring-gray-300',
            'focus-within:ring-2 focus-within:ring-indigo-600',
            'transition-all ease-in-out duration-150',

            'pl-3' => !isset($prepend),
            'pr-3' => !isset($append),
            'h-10' => isset($prepend) || isset($append),
            'py-2' => !isset($prepend) && !isset($append),

            'invalidated:bg-negative-50 invalidated:ring-negative-500 invalidated:dark:ring-negative-700',
            'invalidated:dark:bg-negative-700/10 invalidated:dark:ring-negative-600',

            'validated:bg-positive-50 validated:ring-positive-500 validated:dark:ring-positive-700',
            'validated:dark:bg-positive-700/10 validated:dark:ring-positive-600',
        ]) }}
        name="form.wrapper.container"
    >
        @if ($prefix || $icon)
            <div
                name="form.wrapper.container.prefix"
                @class([
                    'pointer-events-none select-none flex items-center whitespace-nowrap',
                    'text-gray-500 invalidated:text-negative-500 validated:text-positive-500',
                ])
            >
                @if ($icon)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$icon"
                        class="w-4.5 h-4.5"
                    />
                @else
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

        @if ($suffix || $rightIcon)
            <div
                name="form.wrapper.container.suffix"
                @class([
                    'pointer-events-none select-none flex items-center whitespace-nowrap',
                    'text-gray-500 invalidated:text-negative-500 validated:text-positive-500',
                ])
            >
                @if ($rightIcon)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$rightIcon"
                        class="w-4.5 h-4.5"
                    />
                @else
                    <span {{ WireUi::extractAttributes($suffix) }}>
                        {{ $suffix }}
                    </span>
                @endif
            </div>
        @elseif (isset($append))
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

    @if (!$errors->has($name) && $description)
        <label
            class="
                mt-2 text-sm text-gray-500 dark:text-gray-400
                invalidated:text-negative-500 invalidated:dark:text-negative-700
                validated:text-positive-500 validated:dark:text-positive-700
            "
            for="{{ $id }}"
            name="form.wrapper.description"
        >
            {{ $description }}
        </label>
    @endif

    @if ($name && !$errorless)
        <x-dynamic-component
            :component="WireUi::component('error')"
            :name="$name"
        />
    @endif
</div>

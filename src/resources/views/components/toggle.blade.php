<x-wrapper.switcher
    :data="$wrapperData"
    :attributes="$attributes->only(['wire:key'])"
>
    @include('wireui::components.wrapper.slots')

    <label
        tabindex="-1"
        for="{{ $id }}"
        class="relative flex items-center select-none group"
    >
        <input
            {{ $attributes->merge([
                'name' => $name,
                'id'   => $id,
            ])->class([
                'translate-x-0 transform transition ease-in-out duration-200 cursor-pointer shadow',
                'checked:bg-none peer focus:ring-0 focus:ring-offset-0 focus:outline-none bg-white',
                'absolute mx-0.5 my-auto inset-y-0 border-0 appearance-none',
                'checked:text-white dark:bg-secondary-200',
                data_get($sizeClasses, 'circle'),
                $roundedClasses,
            ]) }}
            type="checkbox"
        />

        <div @class([
            'block cursor-pointer transition ease-in-out duration-100',
            'peer-focus:ring-2 peer-focus:ring-offset-2',
            'group-focus:ring-2 group-focus:ring-offset-2',
            data_get($sizeClasses, 'background'),
            $roundedClasses,
            $colorClasses,
        ])></div>
    </label>
</x-wrapper.switcher>
